<?php

namespace Nexus\Domain\User\Listeners;

use Nexus\Domain\Email\Actions\GeneratePasswordResetLinkAction;
use Nexus\Domain\Email\Mail\PasswordSetupMail;
use Nexus\Domain\User\Events\UserCreated;
use Nexus\Domain\User\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendPasswordSetupEmail implements ShouldQueue
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

    public function handle(UserCreated $event): void
    {
        $user = $event->user;

        $this->sendSetupMail($user, $this->resetLinkAction->execute($user));
    }


    /*
    |--------------------------------------------------------------------------
    | Mailer
    |--------------------------------------------------------------------------
    */

    private function sendSetupMail(User $user, string $url): void
    {
        Mail::to($user->email)->send(
            new PasswordSetupMail(
                user: $user,
                url: $url
            )
        );
    }
}
