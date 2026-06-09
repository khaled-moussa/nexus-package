<?php

namespace Nexus\Domain\Quotation\Models;

use Nexus\Domain\Quotation\Models\Builders\QuotationItemQueryBuilder;
use Nexus\Domain\Quotation\Models\Concerns\HasQuotationItemAttribute;
use Nexus\Domain\Quotation\Models\Concerns\HasQuotationItemRelation;
use Nexus\Domain\Quotation\Models\Observer\QuotationItemObserver;
use Nexus\Domain\Quotation\Models\States\QuotationState\QuotationStates;
use Nexus\Support\Concerns\HasUuid;
use Nexus\Support\Models\BaseModel;
use Spatie\ModelStates\HasStates;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

#[ObservedBy(QuotationItemObserver::class)]
class QuotationItem extends BaseModel
{
    use HasFactory;
    use HasStates;
    use HasUuid;
    use HasQuotationItemAttribute;
    use HasQuotationItemRelation;

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
            'quotation_state'  => QuotationStates::class,
            'is_cloned'        => 'boolean',
            'price'            => 'decimal:2',
            'discount'         => 'decimal:2',
            'tax'              => 'decimal:2',
            'created_at'       => 'datetime',
            'updated_at'       => 'datetime',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Builder
    |--------------------------------------------------------------------------
    */

    public function newEloquentBuilder($query): QuotationItemQueryBuilder
    {
        return new QuotationItemQueryBuilder($query);
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

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getDiscount(): float
    {
        return $this->discount;
    }

    public function getTax(): float
    {
        return $this->tax;
    }

    public function getQuotationState(): QuotationStates
    {
        return $this->quotation_state;
    }

    public function getQuotationId(): ?int
    {
        return $this->quotation_id;
    }

    public function getvehicableType(): string
    {
        return $this->vehicable_type;
    }

    public function getvehicableId(): int
    {
        return $this->vehicable_id;
    }

    public function getvehicable(): ?Model
    {
        return $this->vehicable;
    }

    public function getCreatedAt(): ?Carbon
    {
        return $this->created_at;
    }

    public function getUpdatedAt(): ?Carbon
    {
        return $this->updated_at;
    }

    /*
    |--------------------------------------------------------------------------
    | State Checks
    |--------------------------------------------------------------------------
    */

    public function hasPendingQuotation(): bool
    {
        return $this->any_pending_quotation;
    }

    public function pending(): bool
    {
        return $this->is_pending;
    }

    public function accepted(): bool
    {
        return $this->is_accepted;
    }

    public function rejected(): bool
    {
        return $this->is_rejected;
    }
}
