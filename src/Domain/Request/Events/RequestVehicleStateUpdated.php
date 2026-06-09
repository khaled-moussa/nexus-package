<?php

namespace Nexus\Domain\Request\Events;

use Nexus\Domain\Request\Models\Request;
use Nexus\Domain\Request\Models\RequestWorkshop;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RequestVehicleStateUpdated
{
    use Dispatchable;
    use SerializesModels;

    /*
    |--------------------------------------------------------------------------
    | Constructor
    |--------------------------------------------------------------------------
    */

    public function __construct(
        public Request|RequestWorkshop $request,
    ) {}
}
