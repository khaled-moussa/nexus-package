<?php

namespace Nexus\Domain\User\Listeners;

use Nexus\Domain\Email\Actions\GeneratePasswordResetLinkAction;
use Nexus\Domain\Email\Mail\PasswordResetMail;
use Nexus\Domain\User\Events\UserPasswordResetRequested;
use Nexus\Domain\User\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendPasswordResetEmail implements ShouldQueue
{
    /*
    |--------------------------------------------------------------------------
    | Queue Configuration
    |--------------------------------------------------------------------------
    */

    public int $tries = 3;
    public int $backoff = 5;

    /*
    |--------------------------------------------------------------------------
    | Constructor
    |--------------------------------------------------------------------------
    */

    public function __construct(
        private readonly GeneratePasswordResetLinkAction $resetLinkAction
    ) {}

    /*
    |--------------------------------------------------------------------------
    | Handle Event
    |--------------------------------------------------------------------------
    */

    public function handle(UserPasswordResetRequested $event): void
    {
        $user = $event->user;

        if ($this->hasPassword($user)) {
            return;
        }

        $this->sendResetEmail(
            $user,
            $this->resetLinkAction->execute($user)
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Domain Rules
    |--------------------------------------------------------------------------
    */

    private function hasPassword(User $user): bool
    {
        return filled($user->getPassword());
    }

    /*
    |--------------------------------------------------------------------------
    | Mailer
    |--------------------------------------------------------------------------
    */

    private function sendResetEmail(User $user, string $url): void
    {
        Mail::to($user->getEmail())->send(
            new PasswordResetMail(
                user: $user,
                url: $url
            )
        );
    }
}