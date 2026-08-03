<?php

declare(strict_types=1);

namespace Nexus\Domain\Request\Policies;

use Nexus\Support\Policies\BasePolicy;
use Nexus\Domain\Request\Models\RequestWorkshopVehicle;
use Illuminate\Foundation\Auth\User as AuthUser;

class RequestWorkshopVehiclePolicy extends BasePolicy
{
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