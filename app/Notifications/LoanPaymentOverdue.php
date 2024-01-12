<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Payment;

class LoanPaymentOverdue extends Notification implements ShouldQueue
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
                    ->greeting('Alerte de Paiement en Retard')
                    ->line("Nous avons remarqué que votre paiement de prêt de {$this->payment->payment_amount} n'a pas été effectué à temps.")
                    ->action('Effectuer le Paiement', url('/path/to/loan'))
                    ->line('Veuillez effectuer le paiement dès que possible pour éviter des frais supplémentaires.');
    }
}
