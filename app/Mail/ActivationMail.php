<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ActivationMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $userName;
    public string $activationUrl;

    public function __construct(string $userName, string $token)
    {
        $this->userName = $userName;
        $this->activationUrl = route('activate', $token);
    }

    public function envelope(): Envelope
    {
        return new Envelope(subject: 'Kích Hoạt Tài Khoản - Tin Tức Việt');
    }

    public function content(): Content
    {
        return new Content(view: 'emails.activation');
    }
}
