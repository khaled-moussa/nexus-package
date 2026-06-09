<?php

namespace Nexus\Domain\Request\Models\Builders;

use Nexus\Domain\Request\Models\States\VehicleState\{
    VehicleAcceptedState,
    VehicleCompletedState,
    VehicleInProgressState,
    VehiclePendingState,
    VehicleReceivedState,
    VehicleRejectedState
};
use Nexus\Domain\Quotation\Models\States\QuotationState\{
    QuotationPendingState,
    QuotationAcceptedState,
    QuotationRejectedState
};
use Nexus\Domain\Request\Enums\VehicleServiceTypeEnum;
use Illuminate\Database\Eloquent\Builder;

class RequestVehicleQueryBuilder extends Builder
{
    /*
    |--------------------------------------------------------------------------
    | Identifiers
    |--------------------------------------------------------------------------
    */

    public function whereId(int $id): self
    {
        return $this->where('id', $id);
    }

    public function whereUuid(string $uuid): self
    {
        return $this->where('uuid', $uuid);
    }

    /*
    |--------------------------------------------------------------------------
    | Vehicle State
    |--------------------------------------------------------------------------
    */

    public function whereState(string $state): self
    {
        return $this->where('vehicle_state', $state);
    }

    public function whereStateIn(array $states): self
    {
        return $this->whereIn('vehicle_state', $states);
    }

    public function pending(): self
    {
        return $this->whereState(VehiclePendingState::class);
    }

    public function accepted(): self
    {
        return $this->whereState(VehicleAcceptedState::class);
    }

    public function inProgress(): self
    {
        return $this->whereState(VehicleInProgressState::class);
    }

    public function completed(): self
    {
        return $this->whereState(VehicleCompletedState::class);
    }

    public function received(): self
    {
        return $this->whereState(VehicleReceivedState::class);
    }

    public function rejected(): self
    {
        return $this->whereState(VehicleRejectedState::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Quotation State (NEW CLEAN ADDITION)
    |--------------------------------------------------------------------------
    */

    public function quotationState(string $state): self
    {
        return $this->where('quotation_state', $state);
    }

    public function quotationStateIn(array $states): self
    {
        return $this->whereIn('quotation_state', $states);
    }

    public function quotationPending(): self
    {
        return $this->where('quotation_state', QuotationPendingState::class);
    }

    public function quotationAccepted(): self
    {
        return $this->where('quotation_state', QuotationAcceptedState::class);
    }

    public function quotationRejected(): self
    {
        return $this->where('quotation_state', QuotationRejectedState::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Editability
    |--------------------------------------------------------------------------
    */

    public function editable(): self
    {
        return $this->where('can_edit', true);
    }

    public function locked(): self
    {
        return $this->where('can_edit', false);
    }

    /*
    |--------------------------------------------------------------------------
    | Vehicle Info
    |--------------------------------------------------------------------------
    */

    public function wherePlateNumber(string $plateNumber): self
    {
        return $this->where('plate_number', $plateNumber);
    }

    /*
    |--------------------------------------------------------------------------
    | Service Type
    |--------------------------------------------------------------------------
    */

    public function whereServiceType(VehicleServiceTypeEnum $type): self
    {
        return $this->where('service_type', $type->value);
    }

    public function serviceTypes(array $types): self
    {
        return $this->whereIn('service_type', array_map(fn(VehicleServiceTypeEnum $type) => $type->value, $types));
    }

    public function repair(): self
    {
        return $this->where('service_type', VehicleServiceTypeEnum::REPAIR->value);
    }

    public function diagnostic(): self
    {
        return $this->where('service_type', VehicleServiceTypeEnum::DIAGNOSTIC->value);
    }

    /*
    |--------------------------------------------------------------------------
    | Relations
    |--------------------------------------------------------------------------
    */

    public function whereRequest(int $requestId): self
    {
        return $this->where('request_id', $requestId);
    }

    public function whereCity(int $cityId): self
    {
        return $this->where('city_id', $cityId);
    }

    public function whereCountry(int $countryId): self
    {
        return $this->where('country_id', $countryId);
    }

    /*
    |--------------------------------------------------------------------------
    | Eager Loading
    |--------------------------------------------------------------------------
    */

    public function withWorkshopVehicles(int $tenantId): self
    {
        return $this->whereRelation('workshopVehicles', 'tenant_id', '=', $tenantId);
    }

    /*
    |--------------------------------------------------------------------------
    | Grouping
    |--------------------------------------------------------------------------
    */

    public function groupByPlateNumber(): self
    {
        return $this
            ->select([
                'plate_number',
            ])
            ->selectRaw('MIN(id) as id')
            ->selectRaw('MIN(uuid) as uuid')
            ->selectRaw('MIN(manufacturer) as manufacturer')
            ->selectRaw('MIN(model) as model')
            ->selectRaw('MIN(model_year) as model_year')
            ->selectRaw('MIN(vin_number) as vin_number')
            ->withCount('siblings as maintenance_count')
            ->groupBy('plate_number')
            ->orderBy('id');
    }

    public function groupedForWorkshop(int $tenantId): self
    {
        return $this
            ->whereRelation('workshopVehicles', 'tenant_id', $tenantId)
            ->select([
                'plate_number',
            ])
            ->selectRaw('MIN(id) as id')
            ->selectRaw('MIN(uuid) as uuid')
            ->selectRaw('MIN(manufacturer) as manufacturer')
            ->selectRaw('MIN(model) as model')
            ->selectRaw('MIN(model_year) as model_year')
            ->selectRaw('MIN(vin_number) as vin_number')
            ->withCount([
                'siblings as maintenance_count' => fn($query) => $query
                    ->whereHas('workshopVehicles', fn($query) => $query->where('tenant_id', $tenantId)),
            ])
            ->groupBy('plate_number')
            ->orderBy('id');
     }

    /*
    |--------------------------------------------------------------------------
    | Ordering
    |--------------------------------------------------------------------------
    */

    public function latestFirst(): self
    {
        return $this->orderByDesc('created_at');
    }

    public function oldestFirst(): self
    {
        return $this->orderBy('created_at');
    }
}
