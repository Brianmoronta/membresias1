<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Member;

class AlertaVencimientoMembresia extends Mailable
{
    use Queueable, SerializesModels;

    public $member;

    public function __construct(Member $member)
    {
        $this->member = $member;
    }

    public function build()
    {
        return $this->subject('📅 Tu membresía vence pronto')
                    ->markdown('emails.vencimiento');
    }
}
