<?php

namespace Nexus\Domain\User\Actions;

use Nexus\Domain\User\Events\UserPasswordResetRequested;
use Nexus\Domain\User\Models\User;

class ResetUserPasswordAction
{
    /*
    |--------------------------------------------------------------------------
    | Execute
    |--------------------------------------------------------------------------
    */

    public function execute(User $user): void
    {
        $user->forceFill([
            'password' => null,
        ])->save();

        UserPasswordResetRequested::dispatch($user);
    }
}