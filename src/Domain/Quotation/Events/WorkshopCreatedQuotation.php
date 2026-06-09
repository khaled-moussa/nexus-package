<?php

namespace Nexus\Domain\Quotation\Events;

use Nexus\Domain\Request\Models\RequestWorkshop;
use Nexus\Domain\Tenant\Models\Tenant;
use Nexus\Domain\User\Models\User;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class WorkshopCreatedQuotation
{
    use Dispatchable;
    use SerializesModels;

    /*
    |--------------------------------------------------------------------------
    | Constructor
    |--------------------------------------------------------------------------
    */

    public function __construct(
        public RequestWorkshop $request,
    ) {}

    /*
    |--------------------------------------------------------------------------
    | Getters
    |--------------------------------------------------------------------------
    */

    public function getOwner(): ?User
    {
        return $this->request?->owner;
    }


    public function getTenant(): ?Tenant
    {
        return $this->request?->tenant;
    }
}
