<?php

namespace App\Http\Controllers;

use App\Models\MembershipType;
use Illuminate\Http\Request;

class MembershipTypeController extends Controller
{
    public function index()
    {
        $tipos = MembershipType::orderBy('id', 'desc')->paginate(10);
        return view('membership_types.index', compact('tipos'));
    }

    public function create()
    {
        return view('membership_types.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'costo' => 'required|numeric',
            'descuento' => 'nullable|numeric',
            'cantidad_invitados' => 'nullable|integer',
            'color' => 'nullable|string|max:20',
            'background_image' => 'nullable|image|max:2048', // máximo 2MB
            'descripcion' => 'nullable|string',
            'costo_perdida' => 'nullable|numeric',
        ]);

        $tipo = new MembershipType($validated);

        if ($request->hasFile('background_image')) {
            $path = $request->file('background_image')->store('fondos_carnet', 'public');
            $tipo->background_image = 'storage/' . $path;
        }

        $tipo->save();

        return redirect()->route('membership-types.index')->with('success', 'Tipo de membresía creado correctamente.');
    }

    public function edit(MembershipType $membershipType)
    {
        return view('membership_types.edit', compact('membershipType'));
    }

    public function update(Request $request, MembershipType $membershipType)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'costo' => 'required|numeric',
            'descuento' => 'nullable|numeric',
            'cantidad_invitados' => 'nullable|integer',
            'color' => 'nullable|string|max:20',
            'background_image' => 'nullable|image|max:2048',
            'descripcion' => 'nullable|string',
            'costo_perdida' => 'nullable|numeric',
        ]);

        $membershipType->fill($validated);

        if ($request->hasFile('background_image')) {
            $path = $request->file('background_image')->store('fondos_carnet', 'public');
            $membershipType->background_image = 'storage/' . $path;
        }

        $membershipType->save();

        return redirect()->route('membership-types.index')->with('success', 'Tipo de membresía actualizado correctamente.');
    }

    public function destroy(MembershipType $membershipType)
    {
        $membershipType->delete();

        return redirect()->route('membership-types.index')
                         ->with('success', 'Tipo de membresía eliminado correctamente.');
    }
}
