<?php

namespace App\Mail;

use HackerESQ\Settings\Facades\Settings;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UpdateEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $application ;
    /**
     * Create a new message instance.
     */
    public function __construct($application)
    {
        $this->application = $application;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address(Settings::get('email'), Settings::get('site_title_en')),
            subject: 'Application Form #'.$this->application->id,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emailUpdate',
            with: [
                'application' => $this->application,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [
//            Attachment::fromData(fn () => $this->pdf->output(), 'application_form_'.$this->application->id.'.pdf')
//                ->withMime('application/pdf')
        ];
    }
}
