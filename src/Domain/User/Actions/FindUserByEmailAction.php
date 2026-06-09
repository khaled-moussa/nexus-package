<?php

namespace Nexus\Domain\User\Actions;

use Nexus\Domain\User\Models\User;

class FindUserByEmailAction
{
    /*
    |--------------------------------------------------------------------------
    | Execute
    |--------------------------------------------------------------------------
    */

    public function execute(string $email): ?User
    {
        return User::query()
            ->whereEmail($email)
            ->first();
    }
}