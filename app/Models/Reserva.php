<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;

    protected $fillable = [
        'check_in',
        'check_out',
        'rooms',
        'guests',
        'estado',
        'user_id',
        'habitacion_id'
    ];

public function user()
{
    return $this->belongsTo(User::class);
}

public function usuario()
{
    return $this->belongsTo(User::class, 'user_id'); // Asegúrate que sea la columna correcta
}

public function habitacion()
{
    return $this->belongsTo(Habitacion::class, 'habitacion_id');
}


}


