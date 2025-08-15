<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebPage extends Model
{
    protected $fillable = [
    'titulo',
    'slug',
    'imagen_destacada',
    'contenido',
    'tipo',
    'estado'
];
}
