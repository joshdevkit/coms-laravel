<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OtpMail extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    public $otp;
    /**
     * Create a new message instance.
     */
    public function __construct($user, $otp)
    {
        $this->user = $user;
        $this->otp = $otp;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Otp Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function build()
    {
        return $this->subject('Welcome to Construction Management System')
            ->view('emails.otp_mailer_mail')
            ->with([
                'name' => $this->user->fullname,
                'email' => $this->user->email,
                'otp' => $this->otp,
            ]);
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
