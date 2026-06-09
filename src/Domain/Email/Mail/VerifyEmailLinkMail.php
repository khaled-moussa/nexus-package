<?php

namespace Nexus\Domain\Email\Mail;

use Nexus\Domain\User\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Throwable;

class VerifyEmailLinkMail extends Mailable implements ShouldQueue
{
    use Queueable;
    use SerializesModels;

    /*
    |--------------------------------------------------------------------------
    | Queue Configuration
    |--------------------------------------------------------------------------
    */

    public int $tries = 3;

    public int $timeout = 30;

    public function backoff(): array
    {
        return [5, 15, 30];
    }

    /*
    |--------------------------------------------------------------------------
    | Constructor
    |--------------------------------------------------------------------------
    */

    public function __construct(
        public readonly User $user,
        public readonly string $url,
    ) {}

    /*
    |--------------------------------------------------------------------------
    | Envelope
    |--------------------------------------------------------------------------
    */

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: __('Verify Email'),
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Content
    |--------------------------------------------------------------------------
    */

    public function content(): Content
    {
        return new Content(
            view: 'emails.verify-email-link-mail',
            with: [
                'name'  => $this->user->getFullName(),
                'email' => $this->user->getEmail(),
                'url'   => $this->url,
            ],
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Attachments
    |--------------------------------------------------------------------------
    */

    public function attachments(): array
    {
        return [];
    }

    /*
    |--------------------------------------------------------------------------
    | Failure Handling
    |--------------------------------------------------------------------------
    */

    public function failed(Throwable $exception): void
    {
        logger()->error('VerifyEmailLinkMail | Failed.', [
            'user_id' => $this->user->getId(),
            'email'   => $this->user->getEmail(),
            'message' => $exception->getMessage(),
        ]);
    }
}