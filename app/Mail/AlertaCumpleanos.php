<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Member;

class AlertaCumpleanos extends Mailable
{
    use Queueable, SerializesModels;

    public $member;
    public $diasRestantes;

    public function __construct(Member $member, $diasRestantes)
    {
        $this->member = $member;
        $this->diasRestantes = $diasRestantes;
    }

    public function build()
    {
        return $this->subject("🎂 Alerta: {$this->member->name} cumple en {$this->diasRestantes} días")
            ->view('emails.cumpleanos-alerta');
    }
}