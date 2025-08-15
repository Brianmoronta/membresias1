<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MembershipType extends Model
{
    protected $fillable = [
            'nombre',
            'costo',
            'descuento',
            'descripcion',
            'cantidad_invitados',
            'color',
            'costo_perdida'

    ];    

    public function members()
    {
        return $this->hasMany(Member::class, 'membership_type_id');
    }

}

