<?php

namespace Nexus\Role\Actions;

use Nexus\Role\Models\Role;

class CheckRoleAction
{
    public function execute(string $roleName): ?Role
    {
        return Role::query()
            ->whereRole($roleName)
            ->first();
    }
}
