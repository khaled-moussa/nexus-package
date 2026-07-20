<?php

namespace Nexus\Domain\Request\Models\Concerns;

use Nexus\Domain\Quotation\Models\States\QuotationState\QuotationPendingState;
use Nexus\Domain\Request\Models\States\VehicleState\VehicleAcceptedState;
use Nexus\Domain\Request\Models\States\VehicleState\VehicleCompletedState;
use Nexus\Domain\Request\Models\States\VehicleState\VehicleInProgressState;
use Nexus\Domain\Request\Models\States\VehicleState\VehiclePendingState;
use Nexus\Domain\Request\Models\States\VehicleState\VehicleReceivedState;
use Nexus\Domain\Request\Models\States\VehicleState\VehicleRejectedState;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Nexus\Domain\Request\Models\States\VehicleState\VehicleDeliveredState;

trait HasRequestWorkshopVehicleAttribute
{
    /*
    |--------------------------------------------------------------------------
    | Quotation State Attributes
    |--------------------------------------------------------------------------
    */

    protected function anyPendingQuotation(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->quotationItemsLoaded()
                ->contains(fn($item) => $item->getQuotationState() instanceof QuotationPendingState)
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Safe Relation Loader (Performance Fix)
    |--------------------------------------------------------------------------
    */

    private function quotationItemsLoaded()
    {
        return $this->relationLoaded('quotationItems')
            ? $this->quotationItems
            : $this->quotationItems()->get();
    }

    /*
    |--------------------------------------------------------------------------
    | Vehicle State Attributes
    |--------------------------------------------------------------------------
    */

    protected function isPending(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->isState(VehiclePendingState::class)
        );
    }

    protected function isAccepted(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->isState(VehicleAcceptedState::class)
        );
    }

    protected function isInProgress(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->isState(VehicleInProgressState::class)
        );
    }

    protected function isCompleted(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->isState(VehicleCompletedState::class)
        );
    }

    protected function isReceived(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->isState(VehicleReceivedState::class)
        );
    }

    protected function isDelivered(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->isState(VehicleDeliveredState::class)
        );
    }

    protected function isRejected(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->isState(VehicleRejectedState::class)
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Core State Helper
    |--------------------------------------------------------------------------
    */

    private function isState(string $state): bool
    {
        return $this->getVehicleState() instanceof $state;
    }

    /*
|--------------------------------------------------------------------------
| Presentation
|--------------------------------------------------------------------------
*/

    protected function displayTitle(): Attribute
    {
        return Attribute::make(
            get: function (): ?string {

                if (! $this->relationLoaded('requestVehicle')) {
                    return null;
                }

                $vehicle = $this->getRelation('requestVehicle');

                return $vehicle->display_title;
            },
        );
    }

    protected function displayDescription(): Attribute
    {
        return Attribute::make(
            get: function (): ?string {
                if (! $this->relationLoaded('requestVehicle')) {
                    return null;
                }

                $vehicle = $this->getRelation('requestVehicle');

                return $vehicle->display_description;
            },
        );
    }
}
