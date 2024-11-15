<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EchecLivraisonNotification extends Notification
{
    use Queueable;

    protected $colis;
    protected $raison;
    /**
     * Create a new notification instance.
     */
    public function __construct($colis, $raison)
    {
        $this->colis = $colis;
        $this->raison = $raison;
    }


    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
        ->subject('Échec de livraison du colis')
        ->line("Le colis n'a pas pu être livré.")
        ->line("Raison : {$this->raison}")
        ->action('Voir le colis', url('/colis/' . $this->colis->id))
        ->line('Merci de votre compréhension.');

    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
