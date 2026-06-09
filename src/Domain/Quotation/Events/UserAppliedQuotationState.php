<?php

namespace Nexus\Domain\Quotation\Events;

use Nexus\Domain\Request\Models\Request;
use Nexus\Domain\Tenant\Models\Tenant;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserAppliedQuotationState
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

    public function getTenant(): ?Tenant
    {
        return $this->request?->tenant;
    }
}
