<?php

namespace Nexus\Domain\Auth\Actions;

use Nexus\Domain\Auth\Exceptions\LoginException;
use Nexus\Domain\User\Actions\FindUserByEmailAction;
use Nexus\Domain\User\Actions\FindUserSocialAccountAction;
use Nexus\Domain\User\Models\User;
use Laravel\Socialite\Contracts\User as ProviderUser;

class ProviderLoginAction
{
    /*
    |--------------------------------------------------------------------------
    | Constructor
    |--------------------------------------------------------------------------
    */

    public function __construct(
        private readonly FindUserByEmailAction $findUserByEmailAction,
        private readonly FindUserSocialAccountAction $findUserSocialAccountAction,
    ) {}

    /*
    |--------------------------------------------------------------------------
    | Handle
    |--------------------------------------------------------------------------
    */

    public function handle(string $provider, ProviderUser $providerUser): User
    {
        $user = $this->findUserByEmail($providerUser->getEmail());

        $this->ensureUserExists($user);
        $this->ensureUserIsActive($user);
        $this->ensureSocialAccountLinked($user, $provider, $providerUser->getId());

        return $user;
    }

    /*
    |--------------------------------------------------------------------------
    | User Resolution
    |--------------------------------------------------------------------------
    */

    private function findUserByEmail(?string $email): ?User
    {
        return $email
            ? $this->findUserByEmailAction->execute($email)
            : null;
    }

    private function ensureUserExists(?User $user): void
    {
        if (! $user) {
            throw new LoginException('User not found');
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Validation
    |--------------------------------------------------------------------------
    */

    private function ensureUserIsActive(User $user): void
    {
        if (! $user->isActive()) {
            throw new LoginException('Your account is not active, contact administration');
        }
    }

    private function ensureSocialAccountLinked(User $user, string $provider, string $providerId): void
    {
        $account = $this->findUserSocialAccountAction->execute(
            user: $user,
            provider: $provider,
            providerId: $providerId,
        );

        if (! $account) {
            throw new LoginException('No provider account linked');
        }
    }
}