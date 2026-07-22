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

class PasswordSetupMail extends Mailable implements ShouldQueue
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
        $brandName = config('company.brand.name');

        return new Envelope(
            subject: __('Welcome to ') . $brandName,
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Content
    |--------------------------------------------------------------------------
    */

    public function content(): Content
    {
        $brandName = config('company.brand.name');

        return new Content(
            view: 'emails.password-setup-mail',
            with: [
                'brand_name' => $brandName,
                'subject'    => __('Welcome to ') . $brandName,
                'name'       => $this->user->getFullName(),
                'email'      => $this->user->getEmail(),
                'url'        => $this->url,
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
        logger()->error('PasswordSetupMail | Failed', [
            'user_id' => $this->user->getId(),
            'email'   => $this->user->getEmail(),
            'message' => $exception->getMessage(),
        ]);
    }
}
