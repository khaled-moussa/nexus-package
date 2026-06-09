<?php

namespace Nexus\Domain\Tenant\Actions;

use Nexus\Domain\Tenant\Models\Tenant;
use Illuminate\Database\Eloquent\Builder;

class ResolveTenantAction
{
    private static array $cachedTenant = [];

    /*
    |--------------------------------------------------------------------------
    | Execute
    |--------------------------------------------------------------------------
    */

    public function execute(string $tenantSlug): Tenant
    {
        return static::$cachedTenant[$tenantSlug]
            ??= $this->query($tenantSlug)->firstOrFail();
    }

    /*
    |--------------------------------------------------------------------------
    | Queries
    |--------------------------------------------------------------------------
    */

    private function query(string $tenantSlug): Builder
    {
        return Tenant::query()
            ->whereUuid($tenantSlug);
    }
}