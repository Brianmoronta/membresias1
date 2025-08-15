<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class Member extends Model
{
    use Notifiable;
    
    //
    protected $fillable = [
        'name',
        'membership_number',
        'email',
        'membership_type_id',
        'phone',
        'telefono_secundario',
        'photo',
        'membership_type',
        'cedula',
        'preferencia_alimenticia',
        'fecha_membresia',
        'descuento_membresia',
        'total_membresia',
        'enlace_pago',
        'costo_membresia', 
        'fecha_nacimiento',
        'fecha_vencimiento_membresia',
        'codigo_sistema',
        'cantidad_invitados',
        'discount_id',
        'forma_pago',
        'imagen_cedula',
        'user_id'
    ];
    
    public function membershipType()
    {
        return $this->belongsTo(MembershipType::class);
    }
    
   
    public function movimientos()
    {
        return $this->hasMany(Movimiento::class, 'membership_number', 'membership_number');
    }
   
    public function discount()
    {
        return $this->belongsTo(Discount::class);
    }
    
    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }



}

