<?php

namespace Nexus\Domain\Request\Models\Concerns;

use Nexus\Domain\Quotation\Models\QuotationItem;
use Nexus\Domain\Request\Models\Request;
use Nexus\Domain\Request\Models\RequestWorkshopVehicle;
use Nexus\Domain\Tenant\Models\Tenant;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasRequestVehicleRelation
{
    /*
    |--------------------------------------------------------------------------
    | Parent Request
    |--------------------------------------------------------------------------
    */

    public function request(): BelongsTo
    {
        return $this->belongsTo(Request::class);
    }

    public function workshopVehicles(): HasMany
    {
        return $this->hasMany(RequestWorkshopVehicle::class, 'request_vehicle_id');
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

    /*
    |--------------------------------------------------------------------------
    | Self Helpers
    |--------------------------------------------------------------------------
    */

    public function siblings(): HasMany
    {
        return $this->hasMany(static::class, 'plate_number', 'plate_number');
    }
}
