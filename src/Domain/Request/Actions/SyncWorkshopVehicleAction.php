<?php

namespace Nexus\Domain\Request\Actions;

use Nexus\Domain\Request\Models\Request;
use Nexus\Domain\Request\Models\RequestWorkshop;

class SyncWorkshopVehicleAction
{
    public function execute(RequestWorkshop $requestWorkshop, Request $request): void
    {
        /*
        |------------------------------------------------------------------
        | Vehicle IDs
        |------------------------------------------------------------------
        */

        $vehicleIds = $request
            ->vehicles()
            ->pluck('id')
            ->unique()
            ->values()
            ->all();
            
        /*
        |------------------------------------------------------------------
        | Sync Workshop Vehicles
        |------------------------------------------------------------------
        */

        $requestWorkshop
            ->vehicles()
            ->syncWithPivotValues($vehicleIds, [
                'tenant_id' => $requestWorkshop->getTenantId(),
            ]);
    }
}
