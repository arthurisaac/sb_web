<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendSuccessBoxChange extends Mailable
{
    use Queueable, SerializesModels;

    public $box;

    /**
     * Create a new message instance.
     */
    public function __construct($box)
    {
        $this->box = $box;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Votre cadeau a échangé',
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
        return $this->markdown('emails.send-success-box-change');
    }
}
