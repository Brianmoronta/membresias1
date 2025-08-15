<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    protected $fillable = ['membership_number', 'monto', 'concepto', 'fecha'];

    public function miembro()
    {
        return $this->belongsTo(Member::class, 'membership_number', 'membership_number');
    }
}


?>