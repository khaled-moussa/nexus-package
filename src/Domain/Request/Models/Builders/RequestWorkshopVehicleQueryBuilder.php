<?php

namespace Nexus\Domain\Request\Models\Builders;

use Nexus\Domain\Request\Models\States\RequestState\RequestAcceptedState;
use Nexus\Domain\Request\Models\States\RequestState\RequestCompletedState;
use Nexus\Domain\Request\Models\States\RequestState\RequestInProgressState;
use Nexus\Domain\Request\Models\States\RequestState\RequestPendingState;
use Nexus\Domain\Request\Models\States\RequestState\RequestReceivedState;
use Nexus\Domain\Request\Models\States\RequestState\RequestRejectedState;
use Illuminate\Database\Eloquent\Builder;

class RequestWorkshopVehicleQueryBuilder extends Builder
{
    /*
    |--------------------------------------------------------------------------
    | Key Identifiers
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
    | State Filters
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

    /*
    |--------------------------------------------------------------------------
    | Relations
    |--------------------------------------------------------------------------
    */

    public function whereRequestWorkshop(int $requestWorkshopId): self
    {
        return $this->where('request_workshop_id', $requestWorkshopId);
    }

    public function whereRequestVehicle(int $requestVehicleId): self
    {
        return $this->where('request_vehicle_id', $requestVehicleId);
    }

    /*
    |--------------------------------------------------------------------------
    | State Scopes
    |--------------------------------------------------------------------------
    */

    public function pending(): self
    {
        return $this->where('vehicle_state', RequestPendingState::class);
    }

    public function accepted(): self
    {
        return $this->where('vehicle_state', RequestAcceptedState::class);
    }

    public function inProgress(): self
    {
        return $this->where('vehicle_state', RequestInProgressState::class);
    }

    public function completed(): self
    {
        return $this->where('vehicle_state', RequestCompletedState::class);
    }

    public function received(): self
    {
        return $this->where('vehicle_state', RequestReceivedState::class);
    }

    public function rejected(): self
    {
        return $this->where('vehicle_state', RequestRejectedState::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Date Scopes
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

    /*
    |--------------------------------------------------------------------------
    | Grouping
    |--------------------------------------------------------------------------
    */
    public function withVehicleWorkshop(int $tenantId): self
    {
        return $this->whereRelation('vehicleWorkshops', 'tenant_id', '=', $tenantId);
    }
}
