<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ColisAffecteNotification extends Notification
{
    use Queueable;

    public $colisDetails;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($colisDetails)
    {
        $this->colisDetails = $colisDetails;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $message = (new MailMessage)
            ->subject('Nouveaux Colis Affectés')
            ->greeting("Bonjour {$notifiable->prenom} {$notifiable->nom},")
            ->line('Vous avez de nouveaux colis affectés à votre compte.')
            ->line('Voici les détails :');

        foreach ($this->colisDetails as $colis) {
            $message->line("- Colis ID: {$colis->id}, Description: {$colis->description}, Statut: {$colis->statut_colis}");
        }

        $message->line('Merci de vérifier votre tableau de bord pour plus d’informations.')
            ->action('Voir Tableau de Bord', url('/livreur/dashboard'))
            ->line('Merci de votre engagement !');

        return $message;
    }
}
