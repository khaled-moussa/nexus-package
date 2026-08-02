<?php

namespace Nexus\Domain\Role\Actions;

use Nexus\Domain\Role\Models\Role;

class CheckRoleAction
{
    public function execute(string $roleName): ?Role
    {
        return Role::query()
            ->whereRole($roleName)
            ->first();
    }
}
