<?php

namespace Nexus\Domain\Auth\Middlewares;

use Filament\Facades\Filament;
use Filament\Http\Middleware\Authenticate;

class CustomAuthenticate extends Authenticate
{
    /*
    |--------------------------------------------------------------------------
    | Redirect Unauthenticated Users
    |--------------------------------------------------------------------------
    */

    protected function redirectTo($request): ?string
    {
        return Filament::getPanel('auth')->getUrl();
    }
}