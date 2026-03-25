<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $userName;
    public string $resetUrl;

    public function __construct(string $userName, string $token, string $email)
    {
        $this->userName = $userName;
        $this->resetUrl = route('password.reset', ['token' => $token, 'email' => $email]);
    }

    public function envelope(): Envelope
    {
        return new Envelope(subject: 'Đặt Lại Mật Khẩu - Tin Tức Việt');
    }

    public function content(): Content
    {
        return new Content(view: 'emails.reset-password');
    }
}
