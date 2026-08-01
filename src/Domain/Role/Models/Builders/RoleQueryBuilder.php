<?php

namespace App\Nexus\Role\Models\Builders;

use App\Support\Enums\UserPanelEnum;
use Illuminate\Database\Eloquent\Builder;

class RoleQueryBuilder extends Builder
{
    /*
    |--------------------------------------------------------------------------
    | Filters
    |--------------------------------------------------------------------------
    */

    public function wherePanel(UserPanelEnum $panel): self
    {
        return $this->where('panel', $panel->value);
    }

    // #Removed All
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

    public function whenTenant(?int $tenantId = null): self
    {
        return $this->when($tenantId, fn($query) => $query->forCurrentTenant());
    }

    public function whereTenantNull(): self
    {
        return $this->whereNull('tenant_type')->whereNull('tenant_id');
    }

    public function whereRolesExcluded(array $data): self
    {
        return $this->whereNotIn('name', $data);
    }

    public function whereRole(string $role): self
    {
        return $this->where('name', $role);
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */
    public function adminPanel(): self
    {
        return $this->wherePanel(UserPanelEnum::ADMIN);
    }

    public function vendorPanel(): self
    {
        return $this->wherePanel(UserPanelEnum::VENDOR);
    }

    public function userPanel(): self
    {
        return $this->wherePanel(UserPanelEnum::USER);
    }
}
