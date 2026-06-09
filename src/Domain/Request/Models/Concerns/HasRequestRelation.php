<?php

namespace Nexus\Domain\Request\Models\Concerns;

use Nexus\Domain\Quotation\Models\Quotation;
use Nexus\Domain\Request\Models\RequestVehicle;
use Nexus\Domain\Request\Models\RequestWorkshop;
use Nexus\Domain\Tenant\Models\Tenant;
use Nexus\Domain\User\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait HasRequestRelation
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

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /*
    |--------------------------------------------------------------------------
    | Ownership (Simplified & Safer)
    |--------------------------------------------------------------------------
    */

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
    | Children Relations
    |--------------------------------------------------------------------------
    */

    public function vehicles(): HasMany
    {
        return $this->hasMany(RequestVehicle::class);
    }

    public function requestWorkshops(): HasMany
    {
        return $this->hasMany(RequestWorkshop::class);
    }

    public function workshops(): BelongsToMany
    {
        return $this->belongsToMany(
            Tenant::class,
            'request_workshops',
            'request_id',
            'tenant_id'
        )
            ->withTimestamps();
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
}
