<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    
    public function __construct()
    {
        $this->user = $user;
    }

    public function build()
    {
        return $this->subject('Bienvenido a nuestra plataforma')
                    ->view('emails.bienvenido'); // Usa la vista en resources/views/emails/bienvenida.blade.php
    }
}
