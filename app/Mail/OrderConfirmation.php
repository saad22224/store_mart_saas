<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
class OrderConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $order_data;

    public function __construct($order_data)
    {
        $this->order_data = $order_data;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Order Confirmation - ' . $this->order_data['ordernumber'],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'email.order_confirmation',
            with: [
                'order_data' => $this->order_data,
            ],
        );
    }
}
