<?php

namespace App\Http\Controllers;

use App\Models\WebPage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\HeroSetting; // 👈 Agrega arriba si no está

class WebPageController extends Controller
{
    public function index()
    {
        $paginas = WebPage::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.web_pages.index', compact('paginas'));
    }

    public function create()
    {
        return view('admin.web_pages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'contenido' => 'nullable|string',
            'tipo' => 'required|string|max:100',
            'imagen_destacada' => 'nullable|mimes:jpg,jpeg,png,webp,svg|max:10240', // Hasta 10MB
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->titulo);

        if ($request->hasFile('imagen_destacada')) {
            $imagen = $request->file('imagen_destacada')->store('paginas', 'public');
            $data['imagen_destacada'] = $imagen;
        }

        WebPage::create($data);

        return redirect()->route('web-pages.index')->with('success', 'Página creada correctamente.');
    }

    public function edit(WebPage $web_page)
    {
        return view('admin.web_pages.edit', ['pagina' => $web_page]);
    }

    public function update(Request $request, WebPage $web_page)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'contenido' => 'nullable|string',
            'tipo' => 'required|string|max:100',
            'imagen_destacada' => 'nullable|mimes:jpg,jpeg,png,webp,svg|max:10240', // Hasta 10MB
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->titulo);

        if ($request->hasFile('imagen_destacada')) {
            $imagen = $request->file('imagen_destacada')->store('paginas', 'public');
            $data['imagen_destacada'] = $imagen;
        }

        $web_page->update($data);

        return redirect()->route('web-pages.index')->with('success', 'Página actualizada correctamente.');
    }

    public function destroy(WebPage $web_page)
    {
        $web_page->delete();
        return redirect()->route('web-pages.index')->with('success', 'Página eliminada correctamente.');
    }

 

public function mostrarLanding()
{
    $hero = HeroSetting::first(); // ← Aquí el fix real

    return view('web.inicio', compact('hero'));
}


}
