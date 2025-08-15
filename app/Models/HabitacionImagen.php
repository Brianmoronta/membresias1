<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// app/Models/HabitacionImagen.php
class HabitacionImagen extends Model
{
    protected $fillable = ['habitacion_id', 'ruta'];

    public function habitacion()
    {
        return $this->belongsTo(Habitacion::class, 'habitacion_id');
    }
}

