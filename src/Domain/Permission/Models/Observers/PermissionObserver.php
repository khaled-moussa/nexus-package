<?php

namespace Nexus\Domain\Permission\Models\Observers;

use Nexus\Domain\Permission\Models\Permission;
use Filament\Facades\Filament;

class PermissionObserver
{
    /**
     * Handle the User "creating" event.
     */
    public function creating(Permission $permission): void
    {
        if (blank($permission->panel)) {
            $permission->panel = Filament::getCurrentPanel()?->getId();
        }
    }

    /**
     * Handle the User "created" event.
     */
    public function created(Permission $permission): void
    {
        // ...
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(Permission $permission): void
    {
        // ...
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(Permission $permission): void
    {
        // ...
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(Permission $permission): void
    {
        // ...
    }

    /**
     * Handle the User "forceDeleted" event.
     */
    public function forceDeleted(Permission $permission): void
    {
        // ...
    }
}
