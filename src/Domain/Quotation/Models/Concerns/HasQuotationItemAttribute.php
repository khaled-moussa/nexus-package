<?php

namespace Nexus\Domain\Quotation\Models\Concerns;

use Nexus\Domain\Quotation\Models\States\QuotationState\QuotationAcceptedState;
use Nexus\Domain\Quotation\Models\States\QuotationState\QuotationPendingState;
use Nexus\Domain\Quotation\Models\States\QuotationState\QuotationRejectedState;
use Illuminate\Database\Eloquent\Casts\Attribute;

trait HasQuotationItemAttribute
{
    /*
    |--------------------------------------------------------------------------
    | Rates
    |--------------------------------------------------------------------------
    */

    protected function discountRate(): Attribute
    {
        return Attribute::make(get: fn() => ((float) $this->discount ?: 0) / 100);
    }

    protected function taxRate(): Attribute
    {
        return Attribute::make(get: fn() => ((float) $this->tax ?: 0) / 100);
    }

    /*
    |--------------------------------------------------------------------------
    | Core Calculations
    |--------------------------------------------------------------------------
    */

    protected function subtotal(): Attribute
    {
        return Attribute::make(
            get: fn() => round((float) $this->price * (int) $this->quantity, 2)
        );
    }

    protected function priceAfterDiscount(): Attribute
    {
        return Attribute::make(
            get: fn() => round($this->subtotal * (1 - $this->discount_rate), 2)
        );
    }

    protected function taxAmount(): Attribute
    {
        return Attribute::make(
            get: fn() => round($this->price_after_discount * $this->tax_rate, 2)
        );
    }

    protected function total(): Attribute
    {
        return Attribute::make(
            get: fn() => round($this->price_after_discount + $this->tax_amount, 2)
        );
    }

    /*
    |--------------------------------------------------------------------------
    | State Attributes
    |--------------------------------------------------------------------------
    */

    protected function isPending(): Attribute
    {
        return Attribute::make(get: fn() => $this->isState(QuotationPendingState::class));
    }

    protected function isAccepted(): Attribute
    {
        return Attribute::make(get: fn() => $this->isState(QuotationAcceptedState::class));
    }

    protected function isRejected(): Attribute
    {
        return Attribute::make(get: fn() => $this->isState(QuotationRejectedState::class));
    }

    /*
    |--------------------------------------------------------------------------
    | Core State Resolver
    |--------------------------------------------------------------------------
    */

    private function isState(string $state): bool
    {
        return $this->getQuotationState() instanceof $state;
    }
}
