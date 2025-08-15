<?php

namespace App\Exports;

use App\Models\CajaMovimiento;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class MovimientosCajaExport implements FromView
{
    protected $filtros;

    public function __construct($filtros)
    {
        $this->filtros = $filtros;
    }

    public function view(): View
    {
        $query = CajaMovimiento::with('member', 'user');

        if (!empty($this->filtros['nombre'])) {
            $query->whereHas('member', function ($q) {
                $q->where('name', 'like', '%' . $this->filtros['nombre'] . '%');
            });
        }

        if (!empty($this->filtros['desde'])) {
            $query->whereDate('created_at', '>=', $this->filtros['desde']);
        }

        if (!empty($this->filtros['hasta'])) {
            $query->whereDate('created_at', '<=', $this->filtros['hasta']);
        }

        return view('admin.caja.export', [
            'movimientos' => $query->latest()->get()
        ]);
    }
}
