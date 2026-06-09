<?php

namespace Nexus\Domain\Auth\Middlewares;

use Nexus\Domain\Panel\Actions\ResolveUserPanelAction;
use Nexus\Support\Context\AuthContext;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectAuthenticatedUser
{
    /*
    |--------------------------------------------------------------------------
    | Constructor
    |--------------------------------------------------------------------------
    */

    public function __construct(
        private readonly ResolveUserPanelAction $resolveUserPanelAction,
    ) {}

    /*
    |--------------------------------------------------------------------------
    | Handle Request
    |--------------------------------------------------------------------------
    */

    public function handle(Request $request, Closure $next): Response
    {
        if (AuthContext::guest()) {
            return $next($request);
        }

        return $this->redirectUser(AuthContext::user());
    }

    /*
    |--------------------------------------------------------------------------
    | Redirect Logic
    |--------------------------------------------------------------------------
    */

    private function redirectUser($user): Response
    {
        return redirect($this->resolveUserPanelAction->execute($user));
    }
}
