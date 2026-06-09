<?php

namespace Nexus\Domain\Tenant\Models\Builders;

use Nexus\Domain\Tenant\Enums\TenantTypeEnum;
use Illuminate\Database\Eloquent\Builder;

class TenantQueryBuilder extends Builder
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
    | Identity Filters
    |--------------------------------------------------------------------------
    */

    public function whereName(string $name): static
    {
        return $this->where('name', $name);
    }

    /*
    |--------------------------------------------------------------------------
    | Type Filters
    |--------------------------------------------------------------------------
    */

    public function whereType(TenantTypeEnum|string $type): static
    {
        return $this->where('type', $this->normalizeType($type));
    }

    public function whereTypeIn(array $types): static
    {
        return $this->whereIn('type', $this->normalizeTypes($types));
    }

    /*
    |--------------------------------------------------------------------------
    | Relations
    |--------------------------------------------------------------------------
    */

    public function whereOwnerId(int $ownerId): static
    {
        return $this->where('owner_id', $ownerId);
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
        return $this->whereTypeIn([
            TenantTypeEnum::INTERNAL_WORKSHOP,
            TenantTypeEnum::EXTERNAL_WORKSHOP,
        ]);
    }

    public function internalWorkshop(): static
    {
        return $this->whereType(TenantTypeEnum::INTERNAL_WORKSHOP);
    }

    public function externalWorkshop(): static
    {
        return $this->whereType(TenantTypeEnum::EXTERNAL_WORKSHOP);
    }

    /*
    |--------------------------------------------------------------------------
    | Status Scope
    |--------------------------------------------------------------------------
    */

    public function active(): static
    {
        return $this->where('is_active', true);
    }

    public function inactive(): static
    {
        return $this->where('is_active', false);
    }

    /*
    |--------------------------------------------------------------------------
    | Date Scopes
    |--------------------------------------------------------------------------
    */

    public function latestFirst(): static
    {
        return $this->orderByDesc('created_at');
    }

    public function oldestFirst(): static
    {
        return $this->orderBy('created_at');
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    private function normalizeType(TenantTypeEnum|string $type): string
    {
        return $type instanceof TenantTypeEnum ? $type->value : $type;
    }

    private function normalizeTypes(array $types): array
    {
        return array_map(
            fn($type) => $this->normalizeType($type),
            $types
        );
    }
}
