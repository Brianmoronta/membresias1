<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class BienvenidaUsuario extends Notification
{
    protected $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
{
    return (new MailMessage)
        ->subject('🎉 Bienvenido a Club Vista Las Montañas')
        ->view('emails.bienvenida_usuario', ['user' => $this->user]);
}

}
