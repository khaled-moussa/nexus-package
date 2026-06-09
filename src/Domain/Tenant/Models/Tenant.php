<?php

namespace Nexus\Domain\Tenant\Models;

use Nexus\Domain\Tenant\Enums\TenantTypeEnum;
use Nexus\Domain\Tenant\Events\TenantCreated;
use Nexus\Domain\Tenant\Models\Builders\TenantQueryBuilder;
use Nexus\Domain\Tenant\Models\Concerns\HasTenantRelation;
use Nexus\Support\Concerns\HasUuid;
use Nexus\Support\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Carbon;

class Tenant extends BaseModel
{
    use HasFactory;
    use HasUuid;
    use HasTenantRelation;
    
    /*
    |--------------------------------------------------------------------------
    | Events
    |--------------------------------------------------------------------------
    */

    protected $dispatchesEvents = [
        'created' => TenantCreated::class,
    ];

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
            'type'       => TenantTypeEnum::class,
            'is_active'  => 'boolean',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Builder
    |--------------------------------------------------------------------------
    */

    public function newEloquentBuilder($query): TenantQueryBuilder
    {
        return new TenantQueryBuilder($query);
    }

    /*
    |--------------------------------------------------------------------------
    | Getters
    |--------------------------------------------------------------------------
    */

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUuid(): string
    {
        return (string) $this->uuid;
    }

    public function getName(): string
    {
        return (string) $this->name;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function getType(): TenantTypeEnum
    {
        return $this->type;
    }

    public function isActive(): bool
    {
        return (bool) $this->is_active;
    }

    public function getOwnerId(): int
    {
        return $this->owner_id;
    }

    public function getCreatedAt(): ?Carbon
    {
        return $this->created_at;
    }

    public function getUpdatedAt(): ?Carbon
    {
        return $this->updated_at;
    }
}
