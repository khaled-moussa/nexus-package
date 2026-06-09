<?php

namespace Nexus\Domain\Quotation\Models\Observer;

use Nexus\Domain\Quotation\Actions\UpdateQuotationStateAction;
use Nexus\Domain\Quotation\Models\QuotationItem;

class QuotationItemObserver
{
    /*
    |--------------------------------------------------------------------------
    | Updated
    |--------------------------------------------------------------------------
    */

    public function updated(QuotationItem $quotationItem): void
    {
        app(UpdateQuotationStateAction::class)
            ->pending($quotationItem);
    }
}