<?php

namespace Nexus\Domain\Tenant\Events;

use Nexus\Domain\Tenant\Models\Tenant;
use Nexus\Domain\User\Models\User;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TenantCreated
{
    use Dispatchable;
    use SerializesModels;

    /*
    |--------------------------------------------------------------------------
    | Constructor
    |--------------------------------------------------------------------------
    */

    public function __construct(
        public Tenant $tenant,
    ) {}

    /*
    |--------------------------------------------------------------------------
    | Getters
    |--------------------------------------------------------------------------
    */

    public function getOwner(): ?User
    {
        return $this->tenant?->owner;
    }
}
