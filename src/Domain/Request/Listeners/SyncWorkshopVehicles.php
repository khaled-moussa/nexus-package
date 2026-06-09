<?php

namespace Nexus\Domain\Request\Listeners;

use Nexus\Domain\Request\Actions\SyncWorkshopVehicleAction;
use Nexus\Domain\Request\Events\RequestAssignedToWorkshop;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SyncWorkshopVehicles implements ShouldQueue
{
    use InteractsWithQueue;

    /*
    |--------------------------------------------------------------------------
    | Queue Configuration
    |--------------------------------------------------------------------------
    */

    public int $tries = 3;
    public int $backoff = 5;

    /*
    |--------------------------------------------------------------------------
    | Handle Event
    |--------------------------------------------------------------------------
    */

    public function handle(RequestAssignedToWorkshop $event): void
    {
        app(SyncWorkshopVehicleAction::class)->execute(
            $event->requestWorkshop,
            $event->getRequest()
        );
    }
}
