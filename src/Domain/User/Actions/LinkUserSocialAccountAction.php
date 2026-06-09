<?php

namespace Nexus\Domain\User\Actions;

use Nexus\Domain\User\Enums\SocialProviderEnum;
use Nexus\Domain\User\Models\User;

class LinkUserSocialAccountAction
{
    /*
    |--------------------------------------------------------------------------
    | Execute
    |--------------------------------------------------------------------------
    */

    public function execute(
        User $user,
        SocialProviderEnum $provider,
        string $providerId,
    ): void {

        $user->socialAccounts()
            ->firstOrCreate(
                [
                    'provider' => $provider,
                ],
                [
                    'provider_id' => $providerId,
                ],
            );
    }
}
