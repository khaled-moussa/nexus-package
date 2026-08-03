<?php

declare(strict_types=1);

namespace Nexus\Domain\Role\Policies;

use Nexus\Domain\Role\Models\Role;
use Nexus\Support\Policies\BasePolicy;
use Illuminate\Foundation\Auth\User as AuthUser;

class RolePolicy extends BasePolicy
{
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