<?php

namespace Nexus\Domain\User\Actions;

use Nexus\Domain\User\Enums\SocialProviderEnum;
use Nexus\Domain\User\Models\User;

class UnlinkUserSocialAccountAction
{
    /*
    |--------------------------------------------------------------------------
    | Execute
    |--------------------------------------------------------------------------
    */

    public function execute(User $user, SocialProviderEnum $provider): bool
    {
        $query = $user->socialAccounts()
            ->whereProvider($provider);

        if (! $query->exists()) {
            return false;
        }

        $query->delete();

        return true;
    }
}