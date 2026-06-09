<?php

namespace Nexus\Domain\Quotation\Models\Concerns;

use Nexus\Domain\Quotation\Models\Quotation;
use Nexus\Domain\Request\Models\RequestVehicle;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

trait HasQuotationItemRelation
{
    /*
    |--------------------------------------------------------------------------
    | Core Relations
    |--------------------------------------------------------------------------
    */

    public function quotation(): BelongsTo
    {
        return $this->belongsTo(Quotation::class);
    }

    public function vehicable(): MorphTo
    {
        return $this->morphTo();
    }

    public function requestVehicle(): BelongsTo
    {
        return $this->belongsTo(RequestVehicle::class, 'vehicable_id');
    }
}
