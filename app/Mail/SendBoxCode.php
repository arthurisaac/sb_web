<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Attachment;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class SendBoxCode extends Mailable
{
    use Queueable, SerializesModels;

    public $box;
    public $order;
    public $user;
    public $path;

    /**
     * Create a new message instance.
     */
    public function __construct($box, $order, $user)
    {
        $this->user = $user;
        $this->box = $box;
        $this->order = $order;

        $this->path = "storage/qrcode/qrcode.pdf";
        $pdf = new \Spatie\LaravelPdf\Facades\Pdf();
        $pdf::view('pdf.qrcode', ['trique' => $order->trique])
            ->disk('public')
            ->save('qrcode/qrcode.pdf');
        //QrCode::format('png')->generate($order->trique, public_path($this->path) );
        //QrCode::format('png')->generate($order->trique, $this->path );
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

    public function attachments(): array
    {
        return [
            Attachment::fromPath($this->path),
        ];
    }

    public function build()
    {
        return $this->markdown('emails.send-box-code');
    }
}
