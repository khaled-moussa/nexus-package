<?php

namespace App\Nexus\Permission\Models\Builders;

use App\Support\Enums\UserPanelEnum;
use Illuminate\Database\Eloquent\Builder;

class PermissionQueryBuilder extends Builder
{
    /*
    |--------------------------------------------------------------------------
    | Key Filters
    |--------------------------------------------------------------------------
    */

    public function whereAdminPanel(): self
    {
        return $this->where('panel', UserPanelEnum::ADMIN->value);
    }

    public function whereUserPanel(): self
    {
        return $this->where('panel', UserPanelEnum::USER->value);
    }

    public function whereVendorPanel(): self
    {
        return $this->where('panel', UserPanelEnum::VENDOR->value);
    }

    /*
    |--------------------------------------------------------------------------
    | When
    |--------------------------------------------------------------------------
    */

    public function whenTenant(?int $tenantId = null): self
    {
        return $this->when($tenantId, fn($query) => $query->forCurrentTenant());
    }

    /*
    |--------------------------------------------------------------------------
    | Exclusions
    |--------------------------------------------------------------------------
    */

    public function whereTenantNull(): self
    {
        return $this->whereNull('tenant_type')->whereNull('tenant_id');
    }
}
