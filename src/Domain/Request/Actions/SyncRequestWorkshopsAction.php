<?php

namespace Nexus\Domain\Request\Actions;

use Nexus\Domain\Request\Models\Request;

class SyncRequestWorkshopsAction
{
    public function execute(Request $request, array $workshopIds): void
    {
        $selectedWorkshopIds = collect($workshopIds);

        /*
        |------------------------------------------------------------------
        | Existing Workshops
        |------------------------------------------------------------------
        */

        $existingWorkshopIds = $request
            ->requestWorkshops()
            ->pluck('tenant_id');

        /*
        |------------------------------------------------------------------
        | Delete Removed Workshops
        |------------------------------------------------------------------
        */

        $request->requestWorkshops()
            ->whereNotIn('tenant_id', $selectedWorkshopIds)
            ->delete();

        /*
        |------------------------------------------------------------------
        | Create Missing Workshops
        |------------------------------------------------------------------
        */

        $selectedWorkshopIds
            ->diff($existingWorkshopIds)
            ->each(
                fn($tenantId) => $request
                    ->requestWorkshops()
                    ->create([
                        'tenant_id' => $tenantId,
                    ])
            );
    }
}
