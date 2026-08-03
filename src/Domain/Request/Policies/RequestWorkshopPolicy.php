<?php

declare(strict_types=1);

namespace Nexus\Domain\Request\Policies;

use Nexus\Support\Policies\BasePolicy;
use Nexus\Domain\Request\Models\RequestWorkshop;
use Illuminate\Foundation\Auth\User as AuthUser;

class RequestWorkshopPolicy extends BasePolicy
{
    public function viewAny(AuthUser $authUser): bool
    {
        return $this->can($authUser, 'ViewAny:WorkshopRequest');
    }

    public function view(AuthUser $authUser, RequestWorkshop $requestWorkshop): bool
    {
        return $this->can($authUser, 'View:WorkshopRequest');
    }

    public function create(AuthUser $authUser): bool
    {
        return $this->can($authUser, 'Create:WorkshopRequest');
    }

    public function update(AuthUser $authUser, RequestWorkshop $requestWorkshop): bool
    {
        return $this->can($authUser, 'Update:WorkshopRequest');
    }

    public function delete(AuthUser $authUser, RequestWorkshop $requestWorkshop): bool
    {
        return $this->can($authUser, 'Delete:WorkshopRequest');
    }

    public function forceDelete(AuthUser $authUser, RequestWorkshop $requestWorkshop): bool
    {
        return $this->can($authUser, 'ForceDelete:WorkshopRequest');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $this->can($authUser, 'ForceDeleteAny:WorkshopRequest');
    }
}