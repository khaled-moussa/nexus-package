<?php

namespace Nexus\Domain\Email\Actions;

use Nexus\Domain\User\Models\User;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\URL;

class GeneratePasswordResetLinkAction
{
    public function execute(User $user): string
    {
        $token = Password::createToken($user);

        return URL::temporarySignedRoute('filament.auth.auth.password-reset.reset',
            now()->addHours(24),
            [
                'email' => $user->getEmail(),
                'token' => $token,
            ]
        );
    }
}
