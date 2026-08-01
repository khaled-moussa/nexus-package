<?php

declare(strict_types=1);

namespace App\Nexus\Role\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Nexus\Role\Models\Role;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    protected function permissionPrefix(): string
    {
        return filament()->getCurrentPanel()?->getId();
    }

    protected function can(AuthUser $authUser, string $action): bool
    {
        return $authUser->can($action . ':' . $this->permissionPrefix());
    }

    public function viewAny(AuthUser $authUser): bool
    {
        return $this->can($authUser, 'ViewAny:Role');
    }

    public function view(AuthUser $authUser, Role $role): bool
    {
        return $this->can($authUser, 'View:Role');
    }

    public function create(AuthUser $authUser): bool
    {
        return $this->can($authUser, 'Create:Role');
    }

    public function update(AuthUser $authUser, Role $role): bool
    {
        return $this->can($authUser, 'Update:Role');
    }

    public function delete(AuthUser $authUser, Role $role): bool
    {
        return $this->can($authUser, 'Delete:Role');
    }

    public function forceDelete(AuthUser $authUser, Role $role): bool
    {
        return $this->can($authUser, 'ForceDelete:Role');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $this->can($authUser, 'ForceDeleteAny:Role');
    }
}