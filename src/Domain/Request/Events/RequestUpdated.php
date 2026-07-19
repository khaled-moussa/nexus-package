<?php

namespace Nexus\Domain\Request\Events;

use Nexus\Domain\Request\Models\Request;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Nexus\Domain\Request\Models\RequestWorkshop;

class RequestUpdated
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
