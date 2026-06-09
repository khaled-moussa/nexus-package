<?php

namespace Nexus\Domain\Quotation\Models\Concerns;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait HasQuotationAttribute
{
    /*
    |--------------------------------------------------------------------------
    | Active Items (business rule)
    |--------------------------------------------------------------------------
    */

    private function activeItems()
    {
        return $this->items->filter(fn($item) => ! $item->pending() && !$item->rejected());
    }

    /*
    |--------------------------------------------------------------------------
    | Core Calculations
    |--------------------------------------------------------------------------
    */

    protected function subtotal(): Attribute
    {
        return Attribute::make(
            get: fn() => (float) $this->activeItems()->sum(fn($item) => $item->subtotal)
        );
    }

    protected function discountTotal(): Attribute
    {
        return Attribute::make(
            get: fn() => (float) $this->activeItems()->sum(fn($item) => $item->subtotal - $item->priceAfterDiscount)
        );
    }

    protected function taxTotal(): Attribute
    {
        return Attribute::make(
            get: fn() => (float) $this->activeItems()->sum(fn($item) => $item->taxAmount)
        );
    }

    protected function quantityTotal(): Attribute
    {
        return Attribute::make(
            get: fn() => (int) $this->activeItems()->sum(fn($item) => $item->quantity)
        );
    }

    protected function total(): Attribute
    {
        return Attribute::make(
            get: fn() => max(0, $this->subtotal - $this->discountTotal + $this->taxTotal)
        );
    }
}
