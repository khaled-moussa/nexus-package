<?php

namespace Nexus\Domain\User\Models\Concerns;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait HasUserAttribute
{
    /*
    |--------------------------------------------------------------------------
    | Computed Attributes
    |--------------------------------------------------------------------------
    */

    protected function isEmailVerified(): Attribute
    {
        return Attribute::make(get: fn(): bool => $this->email_verified_at !== null);
    }
}
