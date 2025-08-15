<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exportacion extends Model
{
    protected $table = 'exportaciones';
    
    protected $fillable = [
        'tipo', 'fecha_inicio', 'fecha_fin', 'user_id',
    ];
}