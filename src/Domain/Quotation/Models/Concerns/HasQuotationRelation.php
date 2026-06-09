<?php

namespace Nexus\Domain\Quotation\Models\Concerns;

use Nexus\Domain\Quotation\Models\QuotationItem;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasQuotationRelation
{
    /*
    |--------------------------------------------------------------------------
    | Core Relations
    |--------------------------------------------------------------------------
    */

    public function items(): HasMany
    {
        return $this->hasMany(QuotationItem::class);
    }
}