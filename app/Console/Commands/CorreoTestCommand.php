<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class CorreoTestCommand extends Command
{
    protected $signature = 'correo:test';
    protected $description = 'Envía un correo de prueba para validar la configuración SMTP';

    public function handle()
    {
        $email = 'mguzman686@gmail.com'; // Cambia por el destino si quieres

        try {
            Mail::raw('📩 Este es un correo de prueba desde tu sistema Laravel. ¡Todo está funcionando correctamente! 🐐', function ($message) use ($email) {
                $message->to($email)
                    ->subject('✅ Correo de prueba - Todo Virtual');
            });

            $this->info("Correo enviado exitosamente a: $email");
        } catch (\Exception $e) {
            $this->error("❌ Error al enviar el correo: " . $e->getMessage());
        }

        return 0;
    }
}
