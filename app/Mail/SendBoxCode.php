<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendBoxCode extends Mailable
{
    use Queueable, SerializesModels;

    public $box;
    public $order;
    public $user;

    /**
     * Create a new message instance.
     */
    public function __construct($box, $order, $user)
    {
        $this->user = $user;
        $this->box = $box;
        $this->order = $order;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Vous avez reçu un cadeau',
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
        return $this->markdown('emails.send-box-code');
    }
}
