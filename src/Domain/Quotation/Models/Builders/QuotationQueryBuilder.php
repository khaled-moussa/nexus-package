<?php

namespace Nexus\Domain\Quotation\Models\Builders;

use Illuminate\Database\Eloquent\Builder;

class QuotationQueryBuilder extends Builder
{
    /*
    |--------------------------------------------------------------------------
    | Key Identifiers
    |--------------------------------------------------------------------------
    */

    public function whereId(int $id): self
    {
        return $this->whereKey($id);
    }

    public function whereUuid(string $uuid): self
    {
        return $this->where('uuid', $uuid);
    }

    /*
    |--------------------------------------------------------------------------
    | Requestable (Polymorphic filtering)
    |--------------------------------------------------------------------------
    */

    public function whereRequestableType(string $type): self
    {
        return $this->where('requestable_type', $type);
    }

    public function whereRequestableId(int $id): self
    {
        return $this->where('requestable_id', $id);
    }

    public function whereRequestable(int $id, string $type): self
    {
        return $this->whereRequestableId($id)
            ->whereRequestableType($type);
    }

    /*
    |--------------------------------------------------------------------------
    | Relations
    |--------------------------------------------------------------------------
    */

    public function whereTenantId(int $tenantId): self
    {
        return $this->where('tenant_id', $tenantId);
    }

    /*
    |--------------------------------------------------------------------------
    | Date Scopes
    |--------------------------------------------------------------------------
    */

    public function latestFirst(): self
    {
        return $this->orderByDesc('created_at');
    }

    public function oldestFirst(): self
    {
        return $this->orderBy('created_at');
    }
}
