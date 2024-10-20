<?php

namespace App\Notifications\Auth;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordNotification extends Notification
{
    use Queueable;

    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    // Cette méthode définit les canaux à utiliser (ici email)
    public function via($notifiable)
    {
        return ['mail'];
    }

    // Contenu de l'email envoyé à l'utilisateur
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->greeting('Bonjour !')
            ->line('Vous recevez cet email parce que nous avons reçu une demande de réinitialisation de mot de passe pour votre compte.')
            ->action('Réinitialiser le mot de passe', url(config('app.url').'/password/reset/'.$this->token.'?email='.$notifiable->email))
            ->line('Si vous n\'avez pas demandé de réinitialisation de mot de passe, aucune action supplémentaire n\'est requise.');
    }
}
