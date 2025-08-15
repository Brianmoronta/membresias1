<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\MembershipType;
use Illuminate\Http\Request;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Writer;
use Carbon\Carbon;
use App\Notifications\BienvenidaSocio;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Exportacion;
use App\Exports\SociosExport;
use Maatwebsite\Excel\Facades\Excel;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;
use App\Models\Discount;
use App\Models\CajaMovimiento;



class MemberController extends Controller
{
    
public function index(Request $request)
{
    $query = Member::query()->with('usuario');

    // Filtro de búsqueda general
    if ($request->has('buscar')) {
        $buscar = $request->buscar;
        $query->where(function ($q) use ($buscar) {
            $q->where('name', 'like', "%$buscar%")
              ->orWhere('email', 'like', "%$buscar%")
              ->orWhere('membership_number', 'like', "%$buscar%");
        });
    }

    // Si no es superadmin (sucursal ≠ 0), mostrar solo socios de su sucursal
    if (Auth::user()->idsucursal !== 0) {
        $query->whereHas('usuario', function ($q) {
            $q->where('idsucursal', Auth::user()->idsucursal);
        });
    }

    // Paginación y carga de relación usuario
    $members = $query->paginate(10);

    // Cargar tipos de membresía
    $membershipTypes = MembershipType::all();

    // Texto de beneficios para el modal
    $beneficiosTexto = $membershipTypes->map(function ($type) {
        return "- {$type->nombre}: {$type->descripcion}";
    })->implode("\n");

    return view('members.index', compact('members', 'membershipTypes', 'beneficiosTexto'));
}



public function create()
{
    $membershipTypes = MembershipType::select('id', 'nombre', 'costo', 'descuento')->get();
    $discounts = \App\Models\Discount::select('id', 'nombre', 'porcentaje')->get(); // ✅ Aquí traes los descuentos

    return view('members.create', compact('membershipTypes', 'discounts'));
}


public function store(Request $request)
{
    $fechaMembresia = $request->input('fecha_membresia') ?? Carbon::now()->toDateString();

    $data = $request->validate([
        'name' => 'required|string|max:255',
        'membership_number' => 'required|string|unique:members',
        'email' => 'nullable|email',
        'membership_type_id' => 'required|exists:membership_types,id',
        'phone' => 'nullable|string',
        'telefono_secundario' => 'nullable|string',
        'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
        'cedula' => 'nullable|string',
        'preferencia_alimenticia' => 'nullable|string',
        'descuento_membresia' => 'nullable|numeric',
        'total_membresia' => 'nullable|numeric',
        'costo_membresia' => 'nullable|numeric',
        'fecha_nacimiento' => 'nullable|date',
        'fecha_vencimiento_membresia' => 'required|date',
        'discount_id' => 'nullable|exists:discounts,id',
        'forma_pago' => 'required|in:efectivo,tarjeta,transferencia,online,otro',

    ], [
        'membership_number.unique' => 'Este número de membresía ya está en uso.',
        'email.email' => 'El correo no tiene un formato válido.',
        'cedula.unique' => 'Este número de cédula ya está en uso.',
    ]);

    try {
        DB::beginTransaction();

        // 🔹 Cálculo de costos y descuentos antes de guardar el socio
        $membership = MembershipType::findOrFail($request->membership_type_id);
        $costo = $membership->costo;
        $descuentoPorTipo = $membership->descuento;

        $descuentoExtra = 0;
        if ($request->filled('discount_id')) {
            $descuento = \App\Models\Discount::find($request->discount_id);
            if ($descuento && $descuento->tipo_aplicacion === 'membresia') {
                $descuentoExtra = $descuento->porcentaje;
            }
        }

        

        $descuentoGlobal = \App\Models\Discount::where('tipo_aplicacion', 'global')->value('porcentaje') ?? 0;
        $descuentoTotal = ($descuentoExtra > 0) ? $descuentoPorTipo + $descuentoGlobal : $descuentoGlobal;

        $descuentoFinal = round($costo * $descuentoTotal / 100, 2);
        $totalFinal = round($costo - $descuentoFinal, 2);

        $maxIntentos = 3;
        $intento = 0;
        $socio = null;

        while ($intento < $maxIntentos) {
            $intento++;

            $ultimoID = Member::max('id') ?? 0;
            $codigoSistema = 'MBR-' . str_pad($ultimoID + 1, 5, '0', STR_PAD_LEFT);

            try {
                $socio = Member::create([
                    'name' => $request->input('name'),
                    'membership_number' => $request->input('membership_number'),
                    'email' => $request->input('email'),
                    'membership_type_id' => $request->input('membership_type_id'),
                    'phone' => $request->input('phone'),
                    'telefono_secundario' => $request->input('telefono_secundario'),
                    'cedula' => $request->input('cedula'),
                    'preferencia_alimenticia' => $request->input('preferencia_alimenticia'),
                    'fecha_membresia' => $fechaMembresia,
                    'descuento_membresia' => $descuentoFinal,
                    'total_membresia' => $totalFinal,
                    'costo_membresia' => $costo,
                    'fecha_nacimiento' => $request->input('fecha_nacimiento'),
                    'fecha_vencimiento_membresia' => $request->input('fecha_vencimiento_membresia'),
                    'codigo_sistema' => $codigoSistema,
                    'discount_id' => $request->input('discount_id'),
                    'forma_pago' => $request->forma_pago,
                    'user_id' => Auth::id(), // ✅ AÑADIDO AQUÍ
                ]);

                break;
            } catch (\Illuminate\Database\QueryException $e) {
                if ($intento === $maxIntentos) {
                    throw new \Exception('No se pudo generar un código único después de varios intentos.');
                }
                usleep(100000);
            }
        }

        // 🔗 Enlace al pago del carnet
        $enlace = url('/pago/carnet/' . $socio->membership_number);
        $socio->update(['enlace_pago' => $enlace]);

        // 📸 Foto
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
            $socio->update(['photo' => $photoPath]);
        }

        if ($request->hasFile('imagen_cedula')) {
                $cedulaPath = $request->file('imagen_cedula')->store('cedulas', 'public');
                $socio->update(['imagen_cedula' => $cedulaPath]);
            }


        // 📬 Notificación por correo
        if ($socio->email) {
            $socio->notify(new BienvenidaSocio($socio));
        }

        

        // 💸 Registro automático en caja
        CajaMovimiento::create([
        'member_id'   => $socio->id,
        'user_id'     => Auth::id(),
        'monto'       => $socio->total_membresia, // O $totalFinal
        'concepto'    => 'Pago de membresía',
        'forma_pago'  => $request->forma_pago, // 👈 cambio clave aquí
        'referencia'  => null,
    ]);


        DB::commit();

        return redirect()->route('members.index')->with('success', 'Socio registrado correctamente y pago en caja generado.');

    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with('error', 'Ocurrió un error: ' . $e->getMessage());
    }
}

public function carnetPDF($id)
{
    $member = Member::with('membershipType')->findOrFail($id);

    $qrVisita = Builder::create()
        ->writer(new PngWriter())
        ->data(route('visita.registrar', $member->codigo_sistema))
        ->size(200)
        ->margin(10)
        ->build()
        ->getDataUri();

    $qrPoliticas = Builder::create()
        ->writer(new PngWriter())
        ->data(url('/politicas-membresia'))
        ->size(200)
        ->margin(10)
        ->build()
        ->getDataUri();

    $pdf = Pdf::loadView('members.carnet_pdf', compact('member', 'qrVisita', 'qrPoliticas'));
    
    return $pdf->download("Carnet_{$member->codigo_sistema}.pdf");
}




    public function edit($id)
    {
        $member = Member::find($id);
        $membershipTypes = MembershipType::select('id', 'nombre', 'costo', 'descuento')->get();
        $discounts = Discount::all(); // 👈 Agregado

        if (!$member) {
            return redirect()->route('members.index')->with('error', 'Miembro no encontrado.');
        }

        return view('members.edit', compact('member', 'membershipTypes', 'discounts'));
    }

    public function update(Request $request, $id)
    {
        $member = Member::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'membership_number' => 'required|string|unique:members,membership_number,' . $id,
            'email' => 'nullable|email',
            'membership_type_id' => 'required|exists:membership_types,id',
            'phone' => 'nullable|string',
            'telefono_secundario' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'cedula' => 'nullable|string',
            'preferencia_alimenticia' => 'nullable|string',
            'descuento_membresia' => 'nullable|numeric',
            'total_membresia' => 'nullable|numeric',
            'costo_membresia' => 'nullable|numeric',
            'fecha_nacimiento' => 'nullable|date',
            'discount_id' => 'nullable|exists:discounts,id',
            'forma_pago' => 'required|in:efectivo,online',
        ]);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('photos', 'public');
        }

          if   ($request->hasFile('imagen_cedula')) {
                 $data = $request->file('imagen_cedula')->store('cedulas', 'public');
            }


        if ($request->filled('membership_type_id')) {
            $type = MembershipType::find($request->membership_type_id);
            if ($type) {
                $costo = floatval($type->costo);
                $descuento = round($costo * $type->descuento / 100, 2);
                $total = round($costo - $descuento, 2);

                $data['costo_membresia'] = $costo;
                $data['descuento_membresia'] = $descuento;
                $data['total_membresia'] = $total;
            }
        }

        $data['fecha_vencimiento_membresia'] = Carbon::parse($request->input('fecha_vencimiento_membresia'))->format('Y-m-d');

        $member->update($data);

        return redirect()->route('members.index')->with('success', 'Miembro actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $member = Member::findOrFail($id);
        $member->delete();
        return redirect()->route('members.index')->with('success', 'Miembro eliminado exitosamente.');
    }

    public function carnet($id)
{
    $member = Member::with('membershipType')->findOrFail($id);

    $writer = new ImageRenderer(new RendererStyle(200), new SvgImageBackEnd());
    $url = url('/visita/numero/' . $member->membership_number);
    $qrSvg = (new Writer($writer))->writeString($url);

    // 🔥 Obtener fondo desde tipo de membresía
    $fondo = asset($member->membershipType->background_image ?? 'images/fondos_carnet/default.jpg');

    return view('members.carnet', compact('member', 'qrSvg', 'fondo'));
}


    public function carnetLote()
    {
        $members = Member::all();
        return view('members.carnet_lote', compact('members'));
    }

    public function showByNumber($membership_number)
    {
        $user = Auth::user();
        $member = Member::where('membership_number', $membership_number)->firstOrFail();

        if (!$user || ($user->role !== 'admin' && $user->email !== $member->email)) {
            abort(403, 'Acceso no autorizado');
        }

        $fecha_inicio = request('fecha_inicio');
        $fecha_fin = request('fecha_fin');

        $movimientos = $member->movimientos()
            ->when($fecha_inicio, fn($q) => $q->whereDate('fecha', '>=', $fecha_inicio))
            ->when($fecha_fin, fn($q) => $q->whereDate('fecha', '<=', $fecha_fin))
            ->orderByDesc('fecha')
            ->take(10)
            ->get();

        return view('members.show', compact('member', 'movimientos'));
    }

    public function exportarMovimientosPDF($membership_number)
    {
        $user = Auth::user();

        if (!$user || $user->role !== 'admin') {
            abort(403, 'Acceso no autorizado');
        }

        $member = Member::where('membership_number', $membership_number)->firstOrFail();
        $fecha_inicio = request('fecha_inicio');
        $fecha_fin = request('fecha_fin');

        $movimientos = $member->movimientos()
            ->when($fecha_inicio, fn($q) => $q->whereDate('fecha', '>=', $fecha_inicio))
            ->when($fecha_fin, fn($q) => $q->whereDate('fecha', '<=', $fecha_fin))
            ->orderByDesc('fecha')
            ->get();

        $pdf = Pdf::loadView('members.movimientos_pdf', compact('member', 'movimientos'));
        return $pdf->download('movimientos_'.$member->membership_number.'.pdf');
    }

    public function exportarCarnetPDFDobleCara($id)
    {
        $member = Member::with('membershipType')->findOrFail($id);

        $qrFrente = new Writer(
            new ImageRenderer(
                new RendererStyle(200),
                new SvgImageBackEnd()
            )
        );
        $qrSvgFrente = $qrFrente->writeString(url('/visita/numero/' . $member->codigo_sistema));

        $qrPoliticas = new Writer(
            new ImageRenderer(
                new RendererStyle(200),
                new SvgImageBackEnd()
            )
        );
        $qrSvgBack = $qrPoliticas->writeString(url('/politicas-membresia'));

        $pdf = Pdf::loadView('members.carnet_pdf', [
            'member' => $member,
            'qrSvgFrente' => $qrSvgFrente,
            'qrSvgBack' => $qrSvgBack
        ]);

        return $pdf->download('Carnet_' . $member->codigo_sistema . '_doble_cara.pdf');
    }

    public function carnetMiembro()
    {
        $member = Member::where('email', auth()->user()->email)->firstOrFail();

        $writer = new ImageRenderer(new RendererStyle(200), new SvgImageBackEnd());
        $url = url('/visita/numero/' . $member->membership_number);
        $qrSvg = (new Writer($writer))->writeString($url);

        return view('members.carnet', compact('member', 'qrSvg'));
    }

    public function misMovimientos()
    {
        $member = Member::where('email', auth()->user()->email)->firstOrFail();
        $movimientos = $member->movimientos()->orderBy('fecha', 'desc')->get();

        return view('members.movimientos_user', compact('member', 'movimientos'));
    }

    public function exportarSocios(Request $request)
    {
        $desde = $request->input('desde');
        $hasta = $request->input('hasta');

        $existe = Exportacion::where('tipo', 'socios')
            ->where('user_id', Auth::id())
            ->whereDate('fecha_inicio', $desde)
            ->whereDate('fecha_fin', $hasta)
            ->exists();

        if ($existe) {
            return back()->with('error', 'Ya descargaste el Excel con ese rango de fechas.');
        }

        Exportacion::create([
            'tipo' => 'socios',
            'fecha_inicio' => $desde,
            'fecha_fin' => $hasta,
            'user_id' => Auth::id(),
        ]);

        return Excel::download(new SociosExport($desde, $hasta), 'socios.xlsx');
    }
}
