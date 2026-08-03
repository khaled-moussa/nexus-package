<?php

declare(strict_types=1);

namespace Nexus\Domain\Request\Policies;

use Nexus\Support\Policies\BasePolicy;
use Nexus\Domain\Request\Models\RequestVehicle;
use Illuminate\Foundation\Auth\User as AuthUser;

class RequestVehiclePolicy extends BasePolicy
{
    public function viewAny(AuthUser $authUser): bool
    {
        return $this->can($authUser, 'ViewAny:Vehicle');
    }

    public function view(AuthUser $authUser, RequestVehicle $requestVehicle): bool
    {
        return $this->can($authUser, 'View:Vehicle');
    }

    public function create(AuthUser $authUser): bool
    {
        return $this->can($authUser, 'Create:Vehicle');
    }

    public function update(AuthUser $authUser, RequestVehicle $requestVehicle): bool
    {
        return $this->can($authUser, 'Update:Vehicle');
    }

    public function delete(AuthUser $authUser, RequestVehicle $requestVehicle): bool
    {
        return $this->can($authUser, 'Delete:Vehicle');
    }

    public function forceDelete(AuthUser $authUser, RequestVehicle $requestVehicle): bool
    {
        return $this->can($authUser, 'ForceDelete:Vehicle');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $this->can($authUser, 'ForceDeleteAny:Vehicle');
    }
}