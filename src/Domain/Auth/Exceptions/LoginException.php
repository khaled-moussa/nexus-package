<?php

namespace Nexus\Domain\Auth\Exceptions;

class LoginException extends AuthException
{
    public function __construct(?string $message = null)
    {
        parent::__construct(__($message) ?? __('Sorry, the provided credentials are incorrect.'));
    }
}
