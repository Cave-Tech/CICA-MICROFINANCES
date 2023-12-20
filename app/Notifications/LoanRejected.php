<?php

// App\Notifications\LoanRejected.php

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class LoanRejected extends Notification
{
    public $loan;

    public function __construct($loan)
    {
        $this->loan = $loan;
    }

    public function toMail($notifiable)
    {
        $url = url("/loan-details/{$this->loan->id}");

        return (new MailMessage)
            ->line('Votre demande de prêt a été rejetée.')
            ->line("Motif du rejet: {$this->loan->reject_reason}")
            ->action('Voir les détails du prêt', $url)
            ->line('Merci d\'utiliser notre application!');
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'message' => 'Votre demande de prêt a été rejetée.',
            'reason' => $this->loan->reject_reason,
            'url' => url("/loan-details/{$this->loan->id}"),
        ]);
    }
}
