<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Payment;

class LoanPaymentReminder extends Notification implements ShouldQueue
{
    use Queueable;

    public $payment;

    public function __construct($payment)
    {
        $this->payment = $payment;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->greeting('Bonjour,')
                    ->line("Ceci est un rappel que votre paiement de prêt de {$this->payment->payment_amount} est dû demain.")
                    ->action('Voir le Prêt', url('/path/to/loan'))
                    ->line('Merci de faire votre paiement à temps pour éviter les pénalités de retard.');
    }
}
