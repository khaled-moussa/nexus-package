<?php

namespace Nexus\Domain\Tenant\Listeners;

use Nexus\Domain\Tenant\Actions\SyncTenantAction;
use Nexus\Domain\Tenant\Events\TenantCreated;
use Illuminate\Contracts\Queue\ShouldQueue;

class SyncTenantUsers implements ShouldQueue
{
    /*
    |--------------------------------------------------------------------------
    | Queue Configuration
    |--------------------------------------------------------------------------
    */

    public int $tries = 3;
    public int $backoff = 5;

    /*
    |--------------------------------------------------------------------------
    | Construct
    |--------------------------------------------------------------------------
    */

    public function __construct(
        private readonly SyncTenantAction $syncTenantAction
    ) {}

    /*
    |--------------------------------------------------------------------------
    | Handle Event
    |--------------------------------------------------------------------------
    */

    public function handle(TenantCreated $event): void
    {
        $this->syncTenantAction->execute(
            tenant: $event->tenant,
            user: $event->getOwner()
        );
    }
}
