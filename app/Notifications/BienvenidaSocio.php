<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class BienvenidaSocio extends Notification
{
    use Queueable;

    protected $member;

    public function __construct($member)
    {
        $this->member = $member;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('🎉 Bienvenido a Club Vista las Montañas')
            ->markdown('emails.bienvenida_socio', [
                'member' => $this->member,
            ]);
    }
}
