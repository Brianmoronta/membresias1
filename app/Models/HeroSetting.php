<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroSetting extends Model
{
    protected $fillable = [
        'titulo',
        'subtitulo',
        'imagen',
        'boton_texto',
        'boton_url',
        'mostrar_boton',
    ];
}
