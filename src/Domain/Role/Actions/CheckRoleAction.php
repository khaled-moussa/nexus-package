<?php

namespace App\Nexus\Role\Actions;

use App\Nexus\Role\Models\Role;

class CheckRoleAction
{
    public function execute(string $roleName): ?Role
    {
        return Role::query()
            ->whereRole($roleName)
            ->first();
    }
}
