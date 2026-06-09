<?php

namespace Nexus\Domain\Request\Events;

use Nexus\Domain\Request\Models\Request;
use Nexus\Domain\User\Models\User;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RequestCreated
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
}
