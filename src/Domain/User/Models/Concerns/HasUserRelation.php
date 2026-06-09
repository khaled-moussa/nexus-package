<?php

namespace Nexus\Domain\User\Models\Concerns;

use Nexus\Domain\Request\Models\Request;
use Nexus\Domain\Request\Models\RequestWorkshop;
use Nexus\Domain\Setting\UserSetting\Models\UserSetting;
use Nexus\Domain\Tenant\Models\Tenant;
use Nexus\Domain\Tenant\Models\TenantUser;
use Nexus\Domain\User\Models\SocialAccount;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;

trait HasUserRelation
{
    /*
    |--------------------------------------------------------------------------
    | Tenant Relations
    |--------------------------------------------------------------------------
    */

    public function tenant(): HasOne
    {
        return $this->hasOne(Tenant::class, 'owner_id');
    }

    public function tenants(): BelongsToMany
    {
        return $this->belongsToMany(Tenant::class)
            ->using(TenantUser::class)
            ->withTimestamps();
    }

    /*
    |--------------------------------------------------------------------------
    | Social Account Relations
    |--------------------------------------------------------------------------
    */

    public function socialAccounts(): HasMany
    {
        return $this->hasMany(SocialAccount::class);
    }

    /*
    |--------------------------------------------------------------------------
    | User Setting Relations
    |--------------------------------------------------------------------------
    */

    public function settings(): HasOne
    {
        return $this->hasOne(UserSetting::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Request Relations
    |--------------------------------------------------------------------------
    */

    public function organizationRequests(): HasManyThrough
    {
        return $this->hasManyThrough(
            Request::class,
            Tenant::class,
            'owner_id',
            'tenant_id',
            'id',
            'id',
        );
    }

    public function workshopRequests(): HasManyThrough
    {
        return $this->hasManyThrough(
            RequestWorkshop::class,
            Tenant::class,
            'owner_id',
            'tenant_id',
            'id',
            'id',
        );
    }
}