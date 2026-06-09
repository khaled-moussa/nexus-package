<?php

namespace Nexus\Domain\Tenant\Models\Concerns;

use Nexus\Domain\Request\Models\Request;
use Nexus\Domain\Request\Models\RequestWorkshop;
use Nexus\Domain\Tenant\Models\TenantUser;
use Nexus\Domain\User\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasTenantRelation
{
    /*
    |--------------------------------------------------------------------------
    | Core Relations
    |--------------------------------------------------------------------------
    */

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'tenant_user')
            ->using(TenantUser::class)
            ->withTimestamps();
    }

    /*
    |--------------------------------------------------------------------------
    | Requests (if tenant acts as workshop)
    |--------------------------------------------------------------------------
    */

    public function organizationRequests(): HasMany
    {
        return $this->hasMany(Request::class);
    }

    public function workshopRequests(): HasMany
    {
        return $this->hasMany(RequestWorkshop::class);
    }
}
