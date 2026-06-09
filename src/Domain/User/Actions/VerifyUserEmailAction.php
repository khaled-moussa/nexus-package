<?php

namespace Nexus\Domain\User\Actions;

use Nexus\Domain\User\Models\User;

class VerifyUserEmailAction
{
    /*
    |--------------------------------------------------------------------------
    | Execute
    |--------------------------------------------------------------------------
    */

    public function execute(User $user): void
    {
        if ($user->hasVerifiedEmail()) {
            return;
        }

        $user->markEmailAsVerified();
    }
}