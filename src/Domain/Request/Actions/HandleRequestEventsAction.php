<?php

namespace Nexus\Domain\Request\Actions;

use Nexus\Domain\Quotation\Events\AdminCreatedQuotation;
use Nexus\Domain\Quotation\Events\WorkshopCreatedQuotation;
use Nexus\Domain\Request\Events\RequestVehicleStateUpdated;
use Nexus\Domain\Request\Models\Request;
use Nexus\Domain\Request\Models\RequestWorkshop;
use Illuminate\Support\Collection;

class HandleRequestEventsAction
{
    /*
    |--------------------------------------------------------------------------
    | Execute
    |--------------------------------------------------------------------------
    */

    public function execute(Request|RequestWorkshop $request): void
    {
        $vehicles = $this->getVehicles($request);


        if ($vehicles->isEmpty()) {
            return;
        }

        $vehicles->loadMissing('quotationItems');

        if ($this->hasVehicleStateChanges($vehicles)) {
            RequestVehicleStateUpdated::dispatch($request);
        }
        if ($this->hasNewQuotationItems($vehicles)) {

            if ($request instanceof Request) {
                AdminCreatedQuotation::dispatch($request);
            }

            if ($request instanceof RequestWorkshop) {
                WorkshopCreatedQuotation::dispatch($request);
            }
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Relations
    |--------------------------------------------------------------------------
    */

    private function getVehicles(Request|RequestWorkshop $request): Collection
    {
        $relation = match (true) {
            $request instanceof Request => 'vehicles',
            $request instanceof RequestWorkshop => 'workshopVehicles',
        };

        return $request->relationLoaded($relation)
            ? $request->getRelation($relation)
            : collect();
    }

    /*
    |--------------------------------------------------------------------------
    | Conditions
    |--------------------------------------------------------------------------
    */

    private function hasVehicleStateChanges(Collection $vehicles): bool
    {
        return $vehicles->contains(
            fn($vehicle) => $vehicle->wasChanged('vehicle_state')
        );
    }

    private function hasNewQuotationItems(Collection $vehicles): bool
    {
        return $vehicles->contains(fn($vehicle) => $vehicle->quotationItems->contains(fn($item) => $item->wasRecentlyCreated));
    }
}
