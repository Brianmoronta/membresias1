<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::orderBy('orden')->get();
        return view('admin.menus.index', compact('menus'));
    }

    public function create()
    {
        return view('admin.menus.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'url' => 'required',
            'orden' => 'required|integer',
        ]);

        Menu::create([
            'nombre' => $request->nombre,
            'url' => $request->url,
            'orden' => $request->orden,
            'icono' => $request->icono,
            'visible' => $request->has('visible') ? 1 : 0, // 👈 este es el truco
        ]);

        return redirect()->route('admin.menus.index')->with('success', 'Elemento creado');
    }

    public function edit(Menu $menu)
    {
        return view('admin.menus.edit', compact('menu'));
    }

    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'nombre' => 'required',
            'url' => 'required',
            'orden' => 'required|integer',
        ]);

        $menu->update([
            'nombre' => $request->nombre,
            'url' => $request->url,
            'orden' => $request->orden,
            'icono' => $request->icono,
            'visible' => $request->has('visible') ? 1 : 0, // 👈 también aquí
        ]);

        return redirect()->route('admin.menus.index')->with('success', 'Elemento actualizado');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();
        return back()->with('success', 'Eliminado correctamente');
    }
}
