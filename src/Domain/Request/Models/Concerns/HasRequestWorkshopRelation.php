<?php

namespace Nexus\Domain\Request\Models\Concerns;

use Nexus\Domain\Quotation\Models\Quotation;
use Nexus\Domain\Request\Models\Request;
use Nexus\Domain\Request\Models\RequestVehicle;
use Nexus\Domain\Request\Models\RequestWorkshopVehicle;
use Nexus\Domain\Tenant\Models\Tenant;
use Nexus\Domain\User\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait HasRequestWorkshopRelation
{
    /*
    |--------------------------------------------------------------------------
    | Core Relations
    |--------------------------------------------------------------------------
    */

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    public function owner(): HasOneThrough
    {
        return $this->hasOneThrough(
            User::class,   // Final model (User)
            Tenant::class, // Intermediate model (Tenant)
            'id',          // Tenant primary key (referenced by Request)
            'id',          // User primary key (referenced by Tenant)
            'tenant_id',   // Request FK → Tenant.id
            'owner_id'     // Tenant FK → User.id
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Quotation
    |--------------------------------------------------------------------------
    */

    public function quotation(): MorphOne
    {
        return $this->morphOne(Quotation::class, 'requestable');
    }

    /*
    |--------------------------------------------------------------------------
    | Request Relations
    |--------------------------------------------------------------------------
    */

    public function request(): BelongsTo
    {
        return $this->belongsTo(Request::class);
    }

    public function organization(): HasOneThrough
    {
        return $this->hasOneThrough(
            Tenant::class,
            Request::class,
            'id',
            'id',
            'request_id',
            'tenant_id'
        );
    }

    public function creator(): HasOneThrough
    {
        return $this->hasOneThrough(
            User::class,
            Request::class,
            'id',
            'id',
            'request_id',
            'created_by'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Vehicle Relations
    |--------------------------------------------------------------------------
    */

    public function vehicles(): BelongsToMany
    {
        return $this->belongsToMany(
            RequestVehicle::class,
            'request_workshop_vehicles',
            'request_workshop_id',
            'request_vehicle_id'
        )
            ->using(RequestWorkshopVehicle::class)
            ->withTimestamps();
    }

    public function workshopVehicles(): HasMany
    {
        return $this->hasMany(RequestWorkshopVehicle::class);
    }
}
