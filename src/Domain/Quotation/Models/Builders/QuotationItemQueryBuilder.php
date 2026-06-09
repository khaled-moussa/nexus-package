<?php

namespace Nexus\Domain\Quotation\Models\Builders;

use Nexus\Domain\Quotation\Models\States\QuotationState\QuotationAcceptedState;
use Nexus\Domain\Quotation\Models\States\QuotationState\QuotationPendingState;
use Nexus\Domain\Quotation\Models\States\QuotationState\QuotationRejectedState;
use Illuminate\Database\Eloquent\Builder;

class QuotationItemQueryBuilder extends Builder
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
        return $this->where('quotation_state', $state);
    }

    public function whereStateIn(array $states): self
    {
        return $this->whereIn('quotation_state', $states);
    }

    public function whereNotState(string $state): self
    {
        return $this->whereNot('quotation_state',  $state);
    }

    /*
    |--------------------------------------------------------------------------
    | Relations
    |--------------------------------------------------------------------------
    */

    public function whereQuotationId(int $quotationId): self
    {
        return $this->where('quotation_id', $quotationId);
    }

    /*
    |--------------------------------------------------------------------------
    | Requestable (Polymorphic filtering)
    |--------------------------------------------------------------------------
    */

    public function whereVehicableType(string $type): self
    {
        return $this->where('vehicable_type', $type);
    }

    public function whereVehicableId(int $id): self
    {
        return $this->where('vehicable_id', $id);
    }

    public function whereVehicable(int $id, string $type): self
    {
        return $this->whereVehicableId($id)
            ->whereVehicableType($type);
    }

    /*
    |--------------------------------------------------------------------------
    | State Scopes
    |--------------------------------------------------------------------------
    */
    public function pending(): self
    {
        return $this->where('quotation_state', QuotationPendingState::class);
    }

    public function accepted(): self
    {
        return $this->where('quotation_state', QuotationAcceptedState::class);
    }

    public function rejected(): self
    {
        return $this->where('quotation_state', QuotationRejectedState::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Amount Filters
    |--------------------------------------------------------------------------
    */

    public function discounted(): self
    {
        return $this->where('discount', '>', 0);
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
}
