<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\CustomVerifyEmail;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
   protected $fillable = [
    'name',
    'email',
    'password',
    'cedula',
    'idsucursal',
    'role',
];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relación con la sucursal.
     */
    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class, 'idsucursal');
    }

    /**
     * Verifica si el usuario es Superadmin (admin sin sucursal).
     */
    public function isSuperadmin(): bool
    {
        return $this->role === 'admin' && (int) $this->idsucursal === 0;
    }

    /**
     * Verifica si el usuario es un Admin normal (con sucursal).
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin' && (int) $this->idsucursal > 0;
    }

    /**
     * Verifica si el usuario es un Socio (user).
     */
    public function isUser(): bool
    {
        return $this->role === 'user';
    }


public function sendEmailVerificationNotification()
{
    $this->notify(new CustomVerifyEmail);
}

public function reservas()
{
    return $this->hasMany(Reserva::class);
}

    

}
