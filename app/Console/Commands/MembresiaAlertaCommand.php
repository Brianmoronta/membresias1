<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Member;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\AlertaMembresia;

class MembresiaAlertaCommand extends Command
{
    protected $signature = 'alertas:membresia';
    protected $description = 'Envía alerta a los miembros cuya membresía vence en 1 mes';

    public function handle()
{
    $hoy = \Carbon\Carbon::today();
    $alertados = 0;

    $miembros = Member::whereNotNull('fecha_vencimiento_membresia')->get();

    foreach ($miembros as $member) {
        $vencimiento = \Carbon\Carbon::parse($member->fecha_vencimiento_membresia)->startOfDay();

        // Validar que la fecha de vencimiento sea en el futuro
        if ($vencimiento->greaterThan($hoy)) {
            $diasRestantes = $hoy->diffInDays($vencimiento);

            if (in_array($diasRestantes, [30, 31])) {
                Mail::to('mguzman686@gmail.com')->send(
                    new \App\Mail\AlertaMembresia($member)
                );
                $alertados++;
            }
        }
    }

    if ($alertados > 0) {
        $this->info("✅ Se enviaron $alertados alerta(s) de membresía.");
    } else {
        $this->warn("⚠️ No hay membresías por vencer en 1 mes.");
    }

    return 0;
}

}
