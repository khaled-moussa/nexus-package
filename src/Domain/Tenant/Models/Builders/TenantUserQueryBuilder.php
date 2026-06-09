<?php

namespace Nexus\Domain\Tenant\Models\Builders;

use Nexus\Domain\Tenant\Enums\TenantTypeEnum;
use Illuminate\Database\Eloquent\Builder;

class TenantUserQueryBuilder extends Builder
{

    /*
    |--------------------------------------------------------------------------
    | Key Identifiers
    |--------------------------------------------------------------------------
    */

    public function whereId(int $id): static
    {
        return $this->where('id', $id);
    }

    public function whereUuid(string $uuid): static
    {
        return $this->where('uuid', $uuid);
    }

    /*
    |--------------------------------------------------------------------------
    | Relations
    |--------------------------------------------------------------------------
    */

    public function whereUserId(int $userId): static
    {
        return $this->where('user_id', $userId);
    }

    public function whereTenantId(int $tenantId): static
    {
        return $this->where('tenant_id', $tenantId);
    }

    /*
    |--------------------------------------------------------------------------
    | Type Scopes
    |--------------------------------------------------------------------------
    */

    public function organization(): static
    {
        return $this->whereType(TenantTypeEnum::ORGANIZATION);
    }

    public function workshop(): static
    {
        return $this->whereTypeIn('type', [
            TenantTypeEnum::INTERNAL_WORKSHOP,
            TenantTypeEnum::EXTERNAL_WORKSHOP
        ]);
    }
}
