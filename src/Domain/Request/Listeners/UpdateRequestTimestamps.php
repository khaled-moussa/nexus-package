<?php

namespace Nexus\Domain\Request\Listeners;

use Nexus\Domain\Request\Actions\UpdateRequestTimestampsAction;
use Nexus\Domain\Request\Events\RequestUpdated;

class UpdateRequestTimestamps
{
    /*
    |--------------------------------------------------------------------------
    | Handle Event
    |--------------------------------------------------------------------------
    */

    public function handle(RequestUpdated $event): void
    {
        app(UpdateRequestTimestampsAction::class)->execute(
            $event->request,
        );
    }
}
