<?php

declare(strict_types=1);

namespace Nexus\Domain\Request\Policies;

use Nexus\Domain\Request\Models\RequestWorkshopVehicle;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Auth\Access\HandlesAuthorization;

class RequestWorkshopVehiclePolicy
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
        return $this->can($authUser, 'ViewAny:WrkshopVehicle');
    }

    public function view(AuthUser $authUser, RequestWorkshopVehicle $requestWorkshopVehicle): bool
    {
        return $this->can($authUser, 'View:WrkshopVehicle');
    }

    public function create(AuthUser $authUser): bool
    {
        return $this->can($authUser, 'Create:WrkshopVehicle');
    }

    public function update(AuthUser $authUser, RequestWorkshopVehicle $requestWorkshopVehicle): bool
    {
        return $this->can($authUser, 'Update:WrkshopVehicle');
    }

    public function delete(AuthUser $authUser, RequestWorkshopVehicle $requestWorkshopVehicle): bool
    {
        return $this->can($authUser, 'Delete:WrkshopVehicle');
    }

    public function forceDelete(AuthUser $authUser, RequestWorkshopVehicle $requestWorkshopVehicle): bool
    {
        return $this->can($authUser, 'ForceDelete:WrkshopVehicle');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $this->can($authUser, 'ForceDeleteAny:WrkshopVehicle');
    }
}