<?php

// app/Models/Habitacion.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Habitacion extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'capacidad',
        'precio',
        'imagen',
        'estado',
        'es_compartida'
    ];

// app/Models/Habitacion.php

public function getEstadoTextoAttribute()
{
    return match($this->estado) {
        0 => 'No disponible',
        1 => 'Disponible',
        2 => 'Mantenimiento',
        default => 'Desconocido',
    };
}

public function reservas()
{
    return $this->hasMany(Reserva::class, 'habitacion_id');
}


public function imagenes()
{
    return $this->hasMany(HabitacionImagen::class);
}


}
