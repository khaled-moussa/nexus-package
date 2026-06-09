<?php

namespace Nexus\Domain\Auth\Actions;

use Nexus\Domain\Panel\Actions\ResolveUserPanelAction;
use Nexus\Domain\Auth\Actions\LogoutAction;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\Auth;
use Nexus\Domain\User\Models\User;

class ResolveLoginRedirectAction
{
    /*
    |--------------------------------------------------------------------------
    | Constructor
    |--------------------------------------------------------------------------
    */

    public function __construct(
        private readonly ResolveUserPanelAction $resolveUserPanelAction,
        private readonly LogoutAction $logoutAction,
    ) {}

    /*
    |--------------------------------------------------------------------------
    | Handle
    |--------------------------------------------------------------------------
    */

    public function handle(): string
    {
        $user = Auth::user();

        if (! $user) {
            return $this->loginRoute();
        }

        if ($this->isUserInactive($user)) {

            $this->handleInactiveUser();

            return $this->loginRoute();
        }

        return $this->resolveUserPanelAction->execute($user);
    }

    /*
    |--------------------------------------------------------------------------
    | Conditions
    |--------------------------------------------------------------------------
    */

    private function isUserInactive(User $user): bool
    {
        return ! $user->isActive();
    }

    /*
    |--------------------------------------------------------------------------
    | Inactive Handling
    |--------------------------------------------------------------------------
    */

    private function handleInactiveUser(): void
    {
        $this->logoutAction->execute();

        session()->put(
            'auth_failed',
            __('Your account has been disabled. Please contact the administrator.')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Routes
    |--------------------------------------------------------------------------
    */

    private function loginRoute(): string
    {
        return Filament::getPanel('auth')->getUrl();
    }
}
