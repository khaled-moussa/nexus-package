<?php

namespace Nexus\Domain\Quotation\Actions;

use Nexus\Domain\Quotation\Events\AdminAppliedQuotationState;
use Nexus\Domain\Quotation\Events\UserAppliedQuotationState;
use Nexus\Domain\Quotation\Models\Quotation;
use Nexus\Domain\Quotation\Models\QuotationItem;
use Nexus\Domain\Quotation\Models\States\QuotationState\QuotationAcceptedState;
use Nexus\Domain\Quotation\Models\States\QuotationState\QuotationRejectedState;
use Nexus\Domain\Request\Models\Request;
use Nexus\Domain\Request\Models\RequestVehicle;
use Nexus\Domain\Request\Models\RequestWorkshop;
use Nexus\Domain\Request\Models\RequestWorkshopVehicle;
use Illuminate\Support\Collection;
use RuntimeException;

class ApplyQuotationStateAction
{
    /*
    |--------------------------------------------------------------------------
    | Accept
    |--------------------------------------------------------------------------
    */

    public function accept(RequestVehicle|RequestWorkshopVehicle $vehicle): void
    {
        $this->process($vehicle, QuotationAcceptedState::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Reject
    |--------------------------------------------------------------------------
    */

    public function reject(RequestVehicle|RequestWorkshopVehicle $vehicle): void
    {
        $this->process($vehicle, QuotationRejectedState::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Core Process
    |--------------------------------------------------------------------------
    */

    private function process(RequestVehicle|RequestWorkshopVehicle $vehicle, string $state,): void
    {
        $request = $vehicle->request;

        if (! $request) {
            return;
        }

        $quotation = $this->resolveQuotation($request);

        $this->assertRelationLoaded($vehicle);

        $items = $vehicle->quotationItems;

        $this->syncQuotationItems($items, $quotation);

        $hasChanges = $this->applyState($items, $state);

        if ($hasChanges) {
            if ($request instanceof Request) {
                UserAppliedQuotationState::dispatch($request);
            }

            if ($request instanceof RequestWorkshop) {
                AdminAppliedQuotationState::dispatch($request);
            }
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Resolve Quotation
    |--------------------------------------------------------------------------
    */

    private function resolveQuotation(Request|RequestWorkshop $request): Quotation
    {
        return $request->quotation ?? $request->quotation()->create([
            'tenant_id' => $request->getTenantId(),
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Validation
    |--------------------------------------------------------------------------
    */

    private function assertRelationLoaded(
        RequestVehicle|RequestWorkshopVehicle $vehicle,
    ): void {
        if (! $vehicle->relationLoaded('quotationItems')) {
            throw new RuntimeException('quotationItems relation must be eager loaded before applying quotation state.');
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Sync Quotation Items
    |--------------------------------------------------------------------------
    */

    private function syncQuotationItems(
        Collection $items,
        Quotation $quotation,
    ): void {
        $ids = $items
            ->filter(fn(QuotationItem $item) => blank($item->getQuotationId()))
            ->pluck('id');

        if ($ids->isEmpty()) {
            return;
        }

        QuotationItem::query()
            ->whereIn('id', $ids)
            ->update([
                'quotation_id' => $quotation->getId(),
            ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Apply State
    |--------------------------------------------------------------------------
    */

    private function applyState(Collection $items, string $state): bool
    {
        $hasChanges = false;

        $items
            ->filter(fn(QuotationItem $item) => $item->pending())
            ->each(function (QuotationItem $item) use ($state, &$hasChanges) {
                $item->getQuotationState()->transitionTo($state);
                $hasChanges = true;
            });

        return $hasChanges;
    }
}
