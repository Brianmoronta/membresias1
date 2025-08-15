<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; // 👈 ESTE
use Illuminate\Http\Request;
use App\Models\HeroSetting;
use Illuminate\Support\Facades\Storage;

class HeroSettingController extends Controller
{
    public function edit()
    {
        $hero = HeroSetting::firstOrCreate([]);
        return view('admin.hero.edit', compact('hero'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'titulo' => 'nullable|string|max:255',
            'subtitulo' => 'nullable|string|max:255',
            'imagen' => 'nullable|mimes:jpg,jpeg,png,webp|max:10240',
            'boton_texto' => 'nullable|string|max:255',
            'boton_url' => 'nullable|url',
            'mostrar_boton' => 'nullable|boolean',
        ]);

        $hero = HeroSetting::first();

        $data = $request->only(['titulo', 'subtitulo', 'boton_texto', 'boton_url']);
        $data['mostrar_boton'] = $request->has('mostrar_boton');

        if ($request->hasFile('imagen')) {
            if ($hero->imagen) {
                Storage::disk('public')->delete($hero->imagen);
            }
            $data['imagen'] = $request->file('imagen')->store('hero', 'public');
        }

        $hero->update($data);

        return redirect()->back()->with('success', 'Hero actualizado correctamente.');
    }
}
