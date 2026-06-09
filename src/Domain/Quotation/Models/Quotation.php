<?php

namespace Nexus\Domain\Quotation\Models;

use Nexus\Domain\Quotation\Models\Builders\QuotationQueryBuilder;
use Nexus\Domain\Quotation\Models\Concerns\HasQuotationAttribute;
use Nexus\Domain\Quotation\Models\Concerns\HasQuotationRelation;
use Nexus\Support\Concerns\HasUuid;
use Nexus\Support\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Quotation extends BaseModel
{
    use HasFactory;
    use HasUuid;
    use HasQuotationAttribute;
    use HasQuotationRelation;

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
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Builder
    |--------------------------------------------------------------------------
    */

    public function newEloquentBuilder($query): QuotationQueryBuilder
    {
        return new QuotationQueryBuilder($query);
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
        return $this->uuid;
    }

    public function getTenantId(): int
    {
        return $this->tenant_id;
    }

    public function getRequestableType(): string
    {
        return $this->requestable_type;
    }

    public function getRequestableId(): int
    {
        return $this->requestable_id;
    }

    public function getRequestable(): ?Model
    {
        return $this->requestable;
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