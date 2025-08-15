<?php

use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\HeroSettingController;
use App\Http\Controllers\HabitacionController;
use App\Http\Controllers\HabitacionImagenController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\MembershipTypeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VisitaController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\MovimientoController;
use App\Http\Controllers\CajaMovimientoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SucursalController;
use App\Exports\SociosExport;
use App\Models\Member;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MovimientosCajaExport;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Middleware\OnlySuperadmin;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Middleware\ForzarCambioClave;
use App\Http\Middleware\EnsureEmailIsVerifiedSegunRol;
use App\Http\Controllers\Auth\CambioClaveController;
use App\Http\Controllers\ReposicionCarnetController;
use App\Notifications\BienvenidaSocio;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\ReservaController;
use App\Http\Middleware\AdminClubMiddleware;
use App\Http\Controllers\WebPageController;
use App\Http\Controllers\CkeditorController;


Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('redirigir-segun-rol');
    }
    return view('welcome');
})->name('inicio');

Route::get('/redirigir-segun-rol', function () {
    $user = auth()->user();

    if ($user->isSuperadmin()) {
        return redirect()->route('admin.dashboard');
    } elseif ($user->isAdmin()) {
        return redirect()->route('admin.dashboard');
    } elseif ($user->isUser()) {
        return redirect()->route('member.dashboard');
    } else {
        Auth::logout();
        return redirect('/login')->withErrors('Tu cuenta no tiene rol asignado.');
    }
})->name('redirigir-segun-rol');

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
});



Route::middleware(['auth'])->group(function () {
    Route::get('/cambiar-clave', [CambioClaveController::class, 'form'])->name('cambiar-clave.form');
    Route::post('/cambiar-clave', [CambioClaveController::class, 'actualizar'])->name('cambiar-clave.actualizar');
     // Vista de reservas para superadmin y admins del club
    Route::get('/reservas-admin', [ReservaController::class, 'calendarioAdmin'])->name('reservas.admin');
    Route::get('/reservas/{id}/edit', [ReservaController::class, 'edit'])->name('reservas.edit');
    Route::put('/reservas/{id}', [ReservaController::class, 'update'])->name('reservas.update');
    Route::delete('/reservas/{id}', [ReservaController::class, 'destroy'])->name('reservas.destroy');
   





});


Route::middleware(['auth', 'verified.custom', 'forzar.clave'])->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Esta sección puede ser vista por admin Y superadmin
    Route::get('/reposicion-carnet/{member}', [ReposicionCarnetController::class, 'create'])->name('reposicion-carnet.create');
    Route::post('/reposicion-carnet/{member}', [ReposicionCarnetController::class, 'store'])->name('reposicion-carnet.store');


    Route::middleware([OnlySuperadmin::class])->group(function () {
        Route::get('/admin', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::resource('membership-types', MembershipTypeController::class);
        Route::resource('admin/sucursales', SucursalController::class)
            ->names('admin.sucursales')
            ->parameters(['sucursales' => 'sucursal']);

        Route::post('/carnet/imprimir/{id}', [MemberController::class, 'imprimirCarnet'])->name('carnet.imprimir');

        Route::get('/exportar-socios', function (Request $request) {
            $user = Auth::user();
            $desde = $request->query('desde');
            $hasta = $request->query('hasta');

            $existe = \App\Models\Exportacion::where('tipo', 'socios')
                ->where('user_id', $user->id)
                ->whereDate('fecha_inicio', $desde)
                ->whereDate('fecha_fin', $hasta)
                ->exists();

            if ($existe) {
                return back()->with('error', 'Ya descargaste el Excel con ese rango de fechas.');
            }

            \App\Models\Exportacion::create([
                'tipo' => 'socios',
                'fecha_inicio' => $desde,
                'fecha_fin' => $hasta,
                'user_id' => $user->id,
            ]);

            return Excel::download(new SociosExport($desde, $hasta), 'socios.xlsx');
        })->name('exportar.socios');

        Route::get('/admin/usuarios', [UserController::class, 'index'])->name('admin.usuarios.index');
        Route::get('/admin/usuarios/create', [UserController::class, 'create'])->name('admin.usuarios.create');
        Route::post('/admin/usuarios', [UserController::class, 'store'])->name('admin.usuarios.store');
        Route::get('/admin/usuarios/{user}/edit', [UserController::class, 'editRole'])->name('admin.usuarios.edit');
        Route::put('/admin/usuarios/{user}', [UserController::class, 'updateRole'])->name('admin.usuarios.update');
        Route::get('/admin/usuarios/{user}/editar', [UserController::class, 'edit'])->name('admin.usuarios.edit-user');
        Route::put('/admin/usuarios/{user}/guardar', [UserController::class, 'update'])->name('admin.usuarios.update-user');
    });

    Route::middleware('role:admin')->group(function () {
        Route::get('/admin/caja', [CajaMovimientoController::class, 'index'])->name('admin.caja.index');

        Route::get('/admin/caja/exportar', function (Request $request) {
            $fecha = now()->format('Y_m_d_His');
            $nombreArchivo = 'movimientos_caja_' . $fecha . '.xlsx';
            return Excel::download(new MovimientosCajaExport($request->all()), $nombreArchivo);
        })->name('admin.caja.exportar');

        Route::get('/admin/caja/pdf', function (Request $request) {
            $query = \App\Models\CajaMovimiento::with('member', 'user');

            if ($request->filled('nombre')) {
                $query->whereHas('member', function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->nombre . '%');
                });
            }

            if ($request->filled('desde')) {
                $query->whereDate('created_at', '>=', $request->desde);
            }

            if ($request->filled('hasta')) {
                $query->whereDate('created_at', '<=', $request->hasta);
            }

            $movimientos = $query->latest()->get();
            $total = $movimientos->sum('monto');

            $pdf = Pdf::loadView('admin.caja.pdf', compact('movimientos', 'total'));

            $fecha = now()->format('Y_m_d_His');
            return $pdf->stream("reporte_caja_{$fecha}.pdf");
        })->name('admin.caja.pdf');

        Route::post('/caja/confirmar/{id}', [CajaMovimientoController::class, 'confirmar'])->name('caja.confirmar');
        Route::post('/admin/caja/confirmar-con-referencia/{id}', [CajaMovimientoController::class, 'confirmarConReferencia'])->name('caja.confirmar.con.referencia');
    });

    Route::middleware('role:user')->group(function () {
        Route::get('/miembro', [DashboardController::class, 'index'])->name('member.dashboard');

        Route::get('/miembro/carnet', [MemberController::class, 'carnetMiembro'])->name('miembro.carnet');
        Route::get('/miembro/movimientos', [MovimientoController::class, 'misMovimientos'])->name('miembro.movimientos');
        Route::get('/miembro/perfil', [ProfileController::class, 'edit'])->name('miembro.perfil');
    });

    Route::resource('members', MemberController::class);
    Route::get('members/{member}/carnet', [MemberController::class, 'carnet'])->name('members.carnet');
    Route::get('members-carnets-lote', [MemberController::class, 'carnetLote'])->name('members.carnet.lote');
    Route::get('/politicas-membresia', fn() => view('politicas'))->name('politicas.membresia');
    Route::get('members/{member}/carnet-pdf', [MemberController::class, 'carnetPDF'])->name('members.carnet.pdf');

    Route::get('/movimientos/create', [MovimientoController::class, 'create'])->name('movimientos.create');
    Route::post('/movimientos/store', [MovimientoController::class, 'store'])->name('movimientos.store');

    Route::get('/members/numero/{membership_number}', [MemberController::class, 'showByNumber'])->name('members.showByNumber');
    Route::get('/members/numero/{membership_number}/movimientos-pdf', [MemberController::class, 'exportarMovimientosPDF'])->name('members.movimientos.pdf');
});

Route::middleware('ip.autorizada')->get('/visita/numero/{membership_number}', [VisitaController::class, 'registrarPorNumero'])->name('visita.registrar');

Route::get('/pago/carnet/{membership_number}', function ($membership_number) {
    $socio = Member::where('membership_number', $membership_number)->firstOrFail();
    return view('pago.carnet', compact('socio'));
});

Route::post('/verificar-usuario', function (Request $request) {
    $correo = $request->input('email');
    $cedula = $request->input('cedula');

    $existe = User::where('email', $correo)
        ->orWhere('cedula', $cedula)
        ->exists();

    return response()->json(['existe' => $existe]);
});


Route::middleware('auth')->group(function () {

    Route::post('/reservas', [ReservaController::class, 'store'])->name('reservas.store');
    Route::get('/reservar', [ReservaController::class, 'crear'])->name('reservas.crear');
    Route::get('/agendar', [RegisteredUserController::class, 'create'])->name('registro.agendar');

    // Vista con calendario
    Route::get('/calendario-reservas', [ReservaController::class, 'mostrarVista'])->name('reservas.calendario');
    Route::get('/reservas/fechas/{habitacion_id}', [ReservaController::class, 'fechasPorHabitacion']);
    Route::get('/disponibilidad/{fecha}', [ReservaController::class, 'disponibilidadGlobal']);
    Route::get('/mis-reservas/fragmento', [ReservaController::class, 'fragmento'])->name('reservas.fragmento');

    // Info habitación
    Route::get('/habitaciones/{id}/info', [HabitacionController::class, 'info']);
    Route::get('/reservas/fechas/{habitacion}', [ReservaController::class, 'fechas']);

    // Endpoint JSON para FullCalendar
    Route::get('/api/reservas', [ReservaController::class, 'index'])->name('reservas.api');
});

// Admin Club Routes
Route::middleware(['auth', AdminClubMiddleware::class])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // 👉 Subir imágenes (formulario)
        Route::get('/habitaciones/{id}/imagenes/create', [HabitacionImagenController::class, 'create'])
            ->name('habitaciones.imagenes.create');

        // 👉 Guardar imágenes
        Route::post('/habitaciones/{id}/imagenes', [HabitacionImagenController::class, 'store'])
            ->name('habitaciones.imagenes.store');

        // 👉 Ver galería de imágenes (cambiado para evitar conflicto)
        Route::get('/habitaciones/{id}/galeria', [HabitacionController::class, 'verImagenes'])
            ->name('habitaciones.galeria');

        // 👉 Eliminar imagen
        Route::delete('/habitaciones/imagenes/{id}', [HabitacionImagenController::class, 'destroy'])
            ->name('habitaciones.imagenes.delete');

        // 👉 Gestión habitaciones
        Route::resource('habitaciones', HabitacionController::class)->except(['show']);

         
    });


Route::prefix('admin')->middleware(['auth', 'role:admin'])->name('admin.')->group(function () {
    Route::get('hero/edit', [HeroSettingController::class, 'edit'])->name('hero.edit');
    Route::post('hero/update', [HeroSettingController::class, 'update'])->name('hero.update');
    Route::resource('menus', MenuController::class);
    Route::resource('web-pages', WebPageController::class);
});

Route::get('/', function () { return view('welcome'); }); 

//Route::get('/', [WebPageController::class, 'mostrarLanding']);


Route::post('/ckeditor/upload', [CkeditorController::class, 'upload'])->name('ckeditor.upload');


require __DIR__.'/auth.php';
