<?php

namespace Nexus\Domain\Request\Models\Builders;

use Nexus\Domain\Request\Models\States\RequestState\RequestAcceptedState;
use Nexus\Domain\Request\Models\States\RequestState\RequestCompletedState;
use Nexus\Domain\Request\Models\States\RequestState\RequestInProgressState;
use Nexus\Domain\Request\Models\States\RequestState\RequestPendingState;
use Nexus\Domain\Request\Models\States\RequestState\RequestReceivedState;
use Nexus\Domain\Request\Models\States\RequestState\RequestRejectedState;
use Illuminate\Database\Eloquent\Builder;

class RequestWorkshopQueryBuilder extends Builder
{
    /*
    |--------------------------------------------------------------------------
    | Identifiers
    |--------------------------------------------------------------------------
    */

    public function whereId(int $id): static
    {
        return $this->where('id', $id);
    }

    public function whereUuid(string $uuid): static
    {
        return $this->where('uuid', $uuid);
    }

    /*
    |--------------------------------------------------------------------------
    | Workshop Filter
    |--------------------------------------------------------------------------
    */

    public function whereWorkshop(int $tenantId): static
    {
        return $this->where('tenant_id', $tenantId);
    }

    /*
    |--------------------------------------------------------------------------
    | State Filters
    |--------------------------------------------------------------------------
    */

    public function whereState(string $state): static
    {
        return $this->where('request_state', $state);
    }

    public function whereStateIn(array $states): static
    {
        return $this->whereIn('request_state', $states);
    }

    /*
    |--------------------------------------------------------------------------
    | State Scopes
    |--------------------------------------------------------------------------
    */

    public function pending(): static
    {
        return $this->whereState(RequestPendingState::value());
    }

    public function accepted(): static
    {
        return $this->whereState(RequestAcceptedState::value());
    }

    public function inProgress(): static
    {
        return $this->whereState(RequestInProgressState::value());
    }

    public function completed(): static
    {
        return $this->whereState(RequestCompletedState::value());
    }

    public function received(): static
    {
        return $this->whereState(RequestReceivedState::value());
    }

    public function rejected(): static
    {
        return $this->whereState(RequestRejectedState::value());
    }

    /*
    |--------------------------------------------------------------------------
    | Ordering
    |--------------------------------------------------------------------------
    */

    public function latestFirst(): static
    {
        return $this->orderByDesc('created_at');
    }

    public function oldestFirst(): static
    {
        return $this->orderBy('created_at');
    }


    /*
    |--------------------------------------------------------------------------
    | Relation Scopes
    |--------------------------------------------------------------------------
    */

    public function forWorkshopRequestsTable(): static
    {
        return $this
            ->withAggregate('tenant', 'name')
            ->withAggregate('request', 'uuid')
            ->withAggregate('organization', 'name')
            ->withAggregate('creator', 'full_name')

            ->withCount([
                'workshopVehicles as vehicles_count'
            ])

            ->withExists([
                'workshopVehicles as has_quotation' => fn($q) => $q->whereHas('quotationItems'),
            ]);
    }
}
