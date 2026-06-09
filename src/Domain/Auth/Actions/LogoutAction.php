<?php

namespace Nexus\Domain\Auth\Actions;

use Illuminate\Support\Facades\Auth;

class LogoutAction
{
    public function execute(): void
    {
        if (! Auth::check()) {
            return;
        }

        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();
    }
}
