<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TemporaryPasswordMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $temporaryPassword;

    /**
     * Create a new message instance.
     *
     * @param string $temporaryPassword
     */
    public function __construct($temporaryPassword)
    {
        $this->temporaryPassword = $temporaryPassword;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Mot de passe temporaire Mail')
            ->view('emails.temporary_password')
            ->with(['temporaryPassword' => $this->temporaryPassword]);
    }
}
