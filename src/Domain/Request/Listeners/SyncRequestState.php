<?php

namespace Nexus\Domain\Request\Listeners;

use Nexus\Domain\Request\Actions\SyncRequestStateAction;
use Nexus\Domain\Request\Events\RequestVehicleStateUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SyncRequestState implements ShouldQueue
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

    public function handle(RequestVehicleStateUpdated $event): void
    {
        app(SyncRequestStateAction::class)->execute(
            $event->request
        );
    }
}
