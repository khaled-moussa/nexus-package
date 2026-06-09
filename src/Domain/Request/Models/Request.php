<?php

namespace Nexus\Domain\Request\Models;

use Nexus\Domain\Request\Events\RequestCreated;
use Nexus\Domain\Request\Models\Builders\RequestQueryBuilder;
use Nexus\Domain\Request\Models\Concerns\HasRequestAttribute;
use Nexus\Domain\Request\Models\Concerns\HasRequestRelation;
use Nexus\Domain\Request\Models\States\RequestState\RequestStates;
use Nexus\Support\Concerns\HasUuid;
use Nexus\Support\Models\BaseModel;
use Spatie\ModelStates\HasStates;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class Request extends BaseModel
{
    use HasFactory;
    use HasStates;
    use HasUuid;
    use HasRequestAttribute;
    use HasRequestRelation;

    /*
    |--------------------------------------------------------------------------
    | Events
    |--------------------------------------------------------------------------
    */

    protected $dispatchesEvents = [
        'created' => RequestCreated::class,
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
            'request_state' => RequestStates::class,
            'completed_at'  => 'datetime',
            'received_at'   => 'datetime',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Builder
    |--------------------------------------------------------------------------
    */

    public function newEloquentBuilder($query): RequestQueryBuilder
    {
        return new RequestQueryBuilder($query);
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

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function getRequestState(): RequestStates
    {
        return $this->request_state;
    }

    public function getTenantId(): int
    {
        return $this->tenant_id;
    }

    public function getCreatedBy(): int
    {
        return $this->created_by;
    }

    public function getCompletedAt(): ?Carbon
    {
        return $this->completed_at;
    }

    public function getReceivedAt(): ?Carbon
    {
        return $this->received_at;
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
