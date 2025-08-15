<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Member;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class CumpleanosVerificarCommand extends Command
{
    protected $signature = 'cumpleanos:verificar';
    protected $description = 'Verifica los miembros que cumplen años hoy';

    public function handle()
    {      
        $hoy = now();
        $en15dias = now()->addDays(15);

        $miembros = Member::whereNotNull('fecha_nacimiento')
            ->get()
            ->filter(function ($member) use ($hoy, $en15dias) {
                $cumpleanos = \Carbon\Carbon::parse($member->fecha_nacimiento)->setYear($hoy->year);
                return $cumpleanos->isSameDay($hoy) || $cumpleanos->isSameDay($en15dias);
            });

        foreach ($miembros as $member) {
            $cumpleanos = \Carbon\Carbon::parse($member->fecha_nacimiento)->setYear($hoy->year);
            $diasRestantes = (int) $hoy->diffInDays($cumpleanos, false);

            Mail::to('mguzman686@gmail.com')->send(
                new \App\Mail\AlertaCumpleanos($member, $diasRestantes)
            );
        }
            
        return 0;
    }
}
