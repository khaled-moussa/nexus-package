<?php

namespace Nexus\Domain\Tenant\Actions;

use Nexus\Domain\Tenant\Models\Tenant;
use Nexus\Domain\User\Models\User;

class SyncTenantAction
{
    public function execute(User $user, Tenant $tenant): void
    {
        $user->tenants()->sync([
            $tenant->getId()
        ]);
    }
}
