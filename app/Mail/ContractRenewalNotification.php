<?php

namespace App\Mail;

use App\Models\Mou;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContractRenewalNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $mou;

    /**
     * Create a new message instance.
     */
    public function __construct(Mou $mou)
    {
        $this->mou = $mou;
    }

    public function build()
    {
        return $this->subject('Reminder: Contract Expiry Notification')
            ->view('emails.contract_renewal_notification')
            ->with(['mou' => $this->mou]);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Contract Renewal Notification',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'view.name',
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
