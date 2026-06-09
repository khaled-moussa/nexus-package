<?php

namespace Nexus\Domain\Quotation\Actions;

use Nexus\Domain\Quotation\Models\QuotationItem;
use Nexus\Domain\Quotation\Models\States\QuotationState\QuotationPendingState;

class UpdateQuotationStateAction
{
    /*
    |--------------------------------------------------------------------------
    | Pending
    |--------------------------------------------------------------------------
    */

    public function pending(QuotationItem $item): void
    {
        $this->apply($item, QuotationPendingState::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Core Apply Logic
    |--------------------------------------------------------------------------
    */

    private function apply(QuotationItem $item, string $state): void
    {
        if (!$this->hasQuotationChanges($item)) {
            return;
        }

        if ($item->pending()) {
            return;
        }

        $item->getQuotationState()->transitionTo($state);
    }

    /*
    |--------------------------------------------------------------------------
    | Conditions
    |--------------------------------------------------------------------------
    */

    private function hasQuotationChanges(QuotationItem $quotationItem): bool
    {
        return $quotationItem->wasChanged('price', 'discount', 'quantity');
    }
}
