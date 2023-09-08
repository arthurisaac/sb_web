<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendSuccessBuy extends Mailable
{
    use Queueable, SerializesModels;

    public $box;
    public $orderPayment;

    /**
     * Create a new message instance.
     */
    public function __construct($box, $orderPayment)
    {
        $this->box = $box;
        $this->orderPayment = $orderPayment;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Votre commande',
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
        return $this->markdown('emails.send-success-buy');
    }
}