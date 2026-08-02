<?php

namespace Nexus\Domain\Role\Actions;

use Nexus\Domain\Role\Models\Role;
use BezhanSalleh\FilamentShield\Support\Utils;
use Illuminate\Support\Collection;

class RoleSyncPermissionsAction
{
    public function execute(Role $role, Collection $permissions): void
    {
        if ($permissions->isEmpty()) {
            return;
        }

        $permissionModels = Utils::getPermissionModel()::query()
            ->whereIn('name', $permissions)
            ->where('guard_name', $role->getGuardName())
            ->pluck('id');

        $role->syncPermissions($permissionModels);
    }
}
