<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CajaMovimiento extends Model
{
    protected $fillable = [
    'member_id',
    'user_id',
    'monto',
    'concepto',
    'forma_pago',
    'referencia',
    'estado',
    'fecha_confirmacion',
    'confirmado_por',
];


    public function member()
    {
        return $this->belongsTo(\App\Models\Member::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
