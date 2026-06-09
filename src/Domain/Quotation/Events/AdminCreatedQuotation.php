<?php

namespace Nexus\Domain\Quotation\Events;

use Nexus\Domain\Request\Models\Request;
use Nexus\Domain\Tenant\Models\Tenant;
use Nexus\Domain\User\Models\User;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AdminCreatedQuotation
{
    use Dispatchable;
    use SerializesModels;

    /*
    |--------------------------------------------------------------------------
    | Constructor
    |--------------------------------------------------------------------------
    */

    public function __construct(
        public Request $request,
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
