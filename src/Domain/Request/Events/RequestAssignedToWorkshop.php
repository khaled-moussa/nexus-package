<?php

namespace Nexus\Domain\Request\Events;

use Nexus\Domain\Request\Models\Request;
use Nexus\Domain\Request\Models\RequestWorkshop;
use Nexus\Domain\Tenant\Models\Tenant;
use Nexus\Domain\User\Models\User;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RequestAssignedToWorkshop
{
    use Dispatchable;
    use SerializesModels;

    /*
    |--------------------------------------------------------------------------
    | Constructor
    |--------------------------------------------------------------------------
    */

    public function __construct(
        public RequestWorkshop $requestWorkshop,
    ) {}

    /*
    |--------------------------------------------------------------------------
    | Getters
    |--------------------------------------------------------------------------
    */

    public function getOwner(): ?User
    {
        return $this->requestWorkshop?->owner;
    }

    public function getTenant(): ?Tenant
    {
        return $this->requestWorkshop?->tenant;
    }

    public function getRequest(): ?Request
    {
        return $this->requestWorkshop?->request;
    }
}
