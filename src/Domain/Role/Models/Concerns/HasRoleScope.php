<?php

namespace Nexus\Domain\Role\Models\Concerns;

use Nexus\Support\Context\AuthContext;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Attributes\Scope;

trait HasRoleScope
{
    #[Scope]
    public function forCurrentTenant(Builder $query): Builder
    {
        $tenant = AuthContext::tenant();

        if (! $tenant) {
            // No tenant found, return empty query
            return $query->whereRaw('1 = 0');
        }

        return $query->where('tenant_id', $tenant->getKey())
            ->where('tenant_type', get_class($tenant));
    }
}
