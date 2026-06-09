<?php

namespace Nexus\Domain\User\Actions;

use Nexus\Domain\User\Dtos\SocialAccountDto;
use Nexus\Domain\User\Enums\SocialProviderEnum;
use Nexus\Domain\User\Models\User;

class GetUserSocialAccountsAction
{
    /*
    |--------------------------------------------------------------------------
    | Execute
    |--------------------------------------------------------------------------
    */

    public function execute(User $user): array
    {
        $linkedProviders = $this->getLinkedProviders($user);

        return collect(SocialProviderEnum::cases())
            ->map(fn(SocialProviderEnum $provider): SocialAccountDto =>
                new SocialAccountDto(
                    provider: $provider,
                    label: $provider->label(),
                    linked: in_array($provider->value, $linkedProviders, true),
                )
            )
            ->values()
            ->all();
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    private function getLinkedProviders(User $user): array
    {
        return $user->socialAccounts()
            ->pluck('provider')
            ->all();
    }
}
