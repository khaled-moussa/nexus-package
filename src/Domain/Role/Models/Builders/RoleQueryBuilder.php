<?php

namespace App\Nexus\Role\Models\Builders;

use Illuminate\Database\Eloquent\Builder;
use Nexus\Domain\Panel\Enums\PanelTypeEnum;

class RoleQueryBuilder extends Builder
{
    /*
    |--------------------------------------------------------------------------
    | Filters
    |--------------------------------------------------------------------------
    */

    public function wherePanel(PanelTypeEnum $panel): self
    {
        return $this->where('panel', $panel->value);
    }

    // #Removed All
    public function whereAdminPanel(): self
    {
        return $this->where('panel', PanelTypeEnum::ADMIN->value);
    }

    public function whereUserPanel(): self
    {
        return $this->where('panel', PanelTypeEnum::ORGANIZATION->value);
    }

    public function whereVendorPanel(): self
    {
        return $this->where('panel', PanelTypeEnum::WORKSHOP->value);
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
        return $this->wherePanel(PanelTypeEnum::ADMIN);
    }

    public function vendorPanel(): self
    {
        return $this->wherePanel(PanelTypeEnum::ORGANIZATION);
    }

    public function userPanel(): self
    {
        return $this->wherePanel(PanelTypeEnum::WORKSHOP);
    }
}
