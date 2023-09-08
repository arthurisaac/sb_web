<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendReservationRequestAdmin extends Mailable
{
    use Queueable, SerializesModels;

    public $box;
    public $user;
    public $reservation;

    /**
     * Create a new message instance.
     */
    public function __construct($box, $user, $reservation)
    {
        $this->box = $box;
        $this->user = $user;
        $this->reservation = $reservation;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Une réservation a été enregistrée',
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
        return $this->markdown('emails.send-reservation-request-admin');
    }
}
