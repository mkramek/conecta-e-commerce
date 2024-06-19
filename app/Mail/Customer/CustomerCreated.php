<?php

namespace App\Mail\Customer;

use App\Models\ClientECommerce;
use App\Models\CompanyConfig;
use App\Models\Footer;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CustomerCreated extends Mailable
{
    use Queueable, SerializesModels;

    public string $lang;
    public CompanyConfig $company;

    /**
     * Create a new message instance.
     */
    public function __construct(public ClientECommerce $customer)
    {
        $this->lang = app()->getLocale();
        $this->company = CompanyConfig::first();
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: __('Utworzono użytkownika'),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.customer.customer-created',
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
