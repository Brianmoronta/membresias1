<?php

namespace App\Http\Controllers;

use App\Models\Sucursal;
use Illuminate\Http\Request;

class SucursalController extends Controller
{
    public function index()
    {
        $sucursales = Sucursal::all();
        return view('admin.sucursales.index', compact('sucursales'));
    }

    public function create()
    {
        return view('admin.sucursales.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'direccion' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:20',
        ]);

        Sucursal::create($request->all());

        return redirect()->route('admin.sucursales.index')->with('success', 'Sucursal creada correctamente.');
    }

    public function edit(Sucursal $sucursal)
    {
        return view('admin.sucursales.edit', compact('sucursal'));
    }

    public function update(Request $request, Sucursal $sucursal)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'direccion' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:20',
        ]);

        $sucursal->update($request->all());

        return redirect()->route('admin.sucursales.index')->with('success', 'Sucursal actualizada correctamente.');
    }

    public function destroy(Sucursal $sucursal)
    {
        $sucursal->delete();
        return redirect()->route('admin.sucursales.index')->with('success', 'Sucursal eliminada correctamente.');
    }
}
