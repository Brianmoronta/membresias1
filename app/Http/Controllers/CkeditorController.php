<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CkeditorController extends Controller
{
    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $archivo = $request->file('upload');
            $nombre = time() . '_' . $archivo->getClientOriginalName();
            $ruta = $archivo->storeAs('ckeditor', $nombre, 'public');

            $url = asset('storage/' . $ruta);

            return response()->json([
                'uploaded' => 1,
                'fileName' => $nombre,
                'url' => $url
            ]);
        }

        return response()->json(['uploaded' => 0, 'error' => ['message' => 'No se pudo subir el archivo.']]);
    }
}

