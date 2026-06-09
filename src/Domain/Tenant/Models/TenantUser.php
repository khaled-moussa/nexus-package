<?php

namespace Nexus\Domain\Tenant\Models;

use Nexus\Domain\Tenant\Models\Builders\TenantUserQueryBuilder;
use Nexus\Support\Concerns\HasUuid;
use Illuminate\Database\Eloquent\Relations\Pivot;

class TenantUser extends Pivot
{
    use HasUuid;

    /*
    |--------------------------------------------------------------------------
    | Table
    |--------------------------------------------------------------------------
    */

    protected $table = 'tenant_user';

    /*
    |--------------------------------------------------------------------------
    | Mass Assignment
    |--------------------------------------------------------------------------
    */

    protected $guarded = [];

    /*
    |--------------------------------------------------------------------------
    | Casts
    |--------------------------------------------------------------------------
    */

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Builder
    |--------------------------------------------------------------------------
    */

    public function newEloquentBuilder($query): TenantUserQueryBuilder
    {
        return new TenantUserQueryBuilder($query);
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function isActive(): bool
    {
        return $this->is_active;
    }

    public function getTenantId(): int
    {
        return $this->tenant_id;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }
}
