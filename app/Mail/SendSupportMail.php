<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendSupportMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $mail;
    public $message;

    /**
     * Create a new message instance.
     */
    public function __construct($name, $mail, $message)
    {
        $this->name = $name;
        $this->mail = $mail;
        $this->message = $message;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Demande de support Smartbox',
        );
    }

    /**
     * Get the message content definition.
     */
    /*public function content(): Content
    {
        return new Content(
            view: 'view.name',
        );
    }*/

    public function build()
    {
        return $this->markdown('emails.send-support-mail');
    }
}
