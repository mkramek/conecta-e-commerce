<?php

namespace App\Mail\Order;

use App\Models\ClientECommerce;
use App\Models\CompanyConfig;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderPaid extends Mailable
{
    use Queueable, SerializesModels;

    public string $lang;
    public CompanyConfig $company;
    public ClientECommerce $customer;

    /**
     * Create a new message instance.
     */
    public function __construct(public Order $order)
    {
        $this->lang = app()->getLocale();
        $this->company = CompanyConfig::first();
        $this->customer = ClientECommerce::find($order->user_id);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: __('Zamówienie opłacone'),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.order.order-paid',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
