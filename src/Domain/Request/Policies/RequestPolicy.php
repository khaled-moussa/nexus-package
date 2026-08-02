<?php

declare(strict_types=1);

namespace Nexus\Domain\Request\Policies;

use Nexus\Domain\Request\Models\Request;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Auth\Access\HandlesAuthorization;

class RequestPolicy
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
        return $this->can($authUser, 'ViewAny:OrganizationRequest');
    }

    public function view(AuthUser $authUser, Request $request): bool
    {
        return $this->can($authUser, 'View:OrganizationRequest');
    }

    public function create(AuthUser $authUser): bool
    {
        return $this->can($authUser, 'Create:OrganizationRequest');
    }

    public function update(AuthUser $authUser, Request $request): bool
    {
        return $this->can($authUser, 'Update:OrganizationRequest');
    }

    public function delete(AuthUser $authUser, Request $request): bool
    {
        return $this->can($authUser, 'Delete:OrganizationRequest');
    }

    public function forceDelete(AuthUser $authUser, Request $request): bool
    {
        return $this->can($authUser, 'ForceDelete:OrganizationRequest');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $this->can($authUser, 'ForceDeleteAny:OrganizationRequest');
    }
}