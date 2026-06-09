<?php

namespace Nexus\Domain\Panel\Actions;

use Nexus\Domain\User\Models\User;
use Filament\Facades\Filament;

class ResolveUserPanelAction
{
    /*
    |--------------------------------------------------------------------------
    | Execute
    |--------------------------------------------------------------------------
    */

    public function execute(User $user): string
    {
        $panel = $user->getPanel();

        if (is_null($panel)) {
            return $this->loginRoute();
        }

        return Filament::getPanel($panel->value)->getUrl();
    }

    /*
    |--------------------------------------------------------------------------
    | Auth Route
    |--------------------------------------------------------------------------
    */

    private function loginRoute(): string
    {
        return Filament::getPanel('auth')->getUrl();
    }
}
