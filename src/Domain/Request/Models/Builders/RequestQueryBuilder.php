<?php

namespace Nexus\Domain\Request\Models\Builders;

use Nexus\Domain\Request\Models\States\RequestState\RequestAcceptedState;
use Nexus\Domain\Request\Models\States\RequestState\RequestCompletedState;
use Nexus\Domain\Request\Models\States\RequestState\RequestInProgressState;
use Nexus\Domain\Request\Models\States\RequestState\RequestPendingState;
use Nexus\Domain\Request\Models\States\RequestState\RequestReceivedState;
use Nexus\Domain\Request\Models\States\RequestState\RequestRejectedState;
use Illuminate\Database\Eloquent\Builder;

class RequestQueryBuilder extends Builder
{
    /*
    |--------------------------------------------------------------------------
    | Key Identifiers
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
    | State Filters (Single Source of Truth)
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

    public function pending(): static
    {
        return $this->where('request_state', RequestPendingState::value());
    }

    public function accepted(): static
    {
        return $this->where('request_state', RequestAcceptedState::value());
    }

    public function inProgress(): static
    {
        return $this->where('request_state', RequestInProgressState::value());
    }

    public function completed(): static
    {
        return $this->where('request_state', RequestCompletedState::value());
    }

    public function received(): static
    {
        return $this->where('request_state', RequestReceivedState::value());
    }

    public function rejected(): static
    {
        return $this->where('request_state', RequestRejectedState::value());
    }

    /*
    |--------------------------------------------------------------------------
    | Relation Filters
    |--------------------------------------------------------------------------
    */

    public function whereOrganization(int $organizationId): static
    {
        return $this->where('tenant_id', $organizationId);
    }

    public function whereCreatedBy(int $userId): static
    {
        return $this->where('created_by', $userId);
    }

    /*
    |--------------------------------------------------------------------------
    | Sorting
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
    | Listing Optimization (UI Layer Friendly)
    |--------------------------------------------------------------------------
    */

    public function forOrganizationRequestsTable(): static
    {
        return $this
            ->withAggregate('tenant', 'name')
            ->withAggregate('creator', 'full_name')

            ->withCount([
                'vehicles as vehicles_count'
            ])

            ->withExists([
                'vehicles as has_quotation' => fn($query) => $query->whereHas('quotationItems'),
            ]);
    }
}
