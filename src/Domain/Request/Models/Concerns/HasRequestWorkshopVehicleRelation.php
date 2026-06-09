<?php

namespace Nexus\Domain\Request\Models\Concerns;

use Nexus\Domain\Quotation\Models\QuotationItem;
use Nexus\Domain\Request\Models\RequestVehicle;
use Nexus\Domain\Request\Models\RequestWorkshop;
use Nexus\Domain\Tenant\Models\Tenant;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasRequestWorkshopVehicleRelation
{
    /*
    |--------------------------------------------------------------------------
    | Core Relations
    |--------------------------------------------------------------------------
    */

    public function request(): BelongsTo
    {
        return $this->belongsTo(RequestWorkshop::class, 'request_workshop_id');
    }

    public function requestVehicle(): BelongsTo
    {
        return $this->belongsTo(RequestVehicle::class, 'request_vehicle_id');
    }

    /*
    |--------------------------------------------------------------------------
    | Tenancy
    |--------------------------------------------------------------------------
    */

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Quotation Items
    |--------------------------------------------------------------------------
    */

    public function quotationItems(): MorphMany
    {
        return $this->morphMany(QuotationItem::class, 'vehicable');
    }
}
