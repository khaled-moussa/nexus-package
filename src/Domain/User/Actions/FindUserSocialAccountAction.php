<?php

namespace Nexus\Domain\User\Actions;

use Nexus\Domain\User\Models\SocialAccount;
use Nexus\Domain\User\Models\User;

class FindUserSocialAccountAction
{
    /*
    |--------------------------------------------------------------------------
    | Execute
    |--------------------------------------------------------------------------
    */

    public function execute(
        User $user,
        string $provider,
        string $providerId,
    ): ?SocialAccount {

        return SocialAccount::query()
            ->whereUserId($user->getId())
            ->whereProvider($provider)
            ->whereProviderId($providerId)
            ->first();
    }
}
