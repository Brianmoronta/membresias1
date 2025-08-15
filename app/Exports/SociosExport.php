<?php

namespace App\Exports;

use App\Models\Member;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SociosExport implements FromCollection, WithHeadings
{
    protected $desde;
    protected $hasta;

    public function __construct($desde, $hasta)
    {
        $this->desde = $desde;
        $this->hasta = $hasta;
    }

    public function collection()
    {
        return Member::with('membershipType') // relación
        ->get()
        ->map(function ($member) {
            return [
                'Nombre'               => $member->name,
                'Cédula'               => $member->cedula,
                'Tipo de Membresía'    => optional($member->membershipType)->nombre, // aquí cambiamos el ID por el nombre
                'Fecha de Membresía' => \Carbon\Carbon::parse($member->fecha_membresia)->format('d/m/Y'),
                'Monto de Descuento'   => number_format($member->descuento_membresia, 2),
                'Cantidad de Invitados' => optional($member->membershipType)->cantidad_invitados ?? 0,

            ];
        });
    }

    public function headings(): array
    {
        return [
            'Nombre',
            'Cédula',
            'Tipo de Membresía (ID)',
            'Fecha de Membresía',
            'Descuento',
            'Cantidad de Invitados',
        ];
    }
}
