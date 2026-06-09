<?php

namespace Nexus\Domain\Request\Models;

use Nexus\Domain\Request\Events\RequestAssignedToWorkshop;
use Nexus\Domain\Request\Models\Builders\RequestWorkshopQueryBuilder;
use Nexus\Domain\Request\Models\Concerns\HasRequestWorkshopAttribute;
use Nexus\Domain\Request\Models\Concerns\HasRequestWorkshopRelation;
use Nexus\Domain\Request\Models\States\RequestState\RequestStates;
use Nexus\Support\Concerns\HasUuid;
use Nexus\Support\Models\BaseModel;
use Carbon\Carbon;
use Spatie\ModelStates\HasStates;

class RequestWorkshop extends BaseModel
{
    use HasUuid;
    use HasStates;
    use HasRequestWorkshopAttribute;
    use HasRequestWorkshopRelation;

    /*
    |--------------------------------------------------------------------------
    | Events
    |--------------------------------------------------------------------------
    */

    protected $dispatchesEvents = [
        'created' => RequestAssignedToWorkshop::class,
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

    public function newEloquentBuilder($query): RequestWorkshopQueryBuilder
    {
        return new RequestWorkshopQueryBuilder($query);
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

    public function getRequestState(): RequestStates
    {
        return $this->request_state;
    }

    public function getRequestId(): int
    {
        return $this->request_id;
    }

    public function getTenantId(): int
    {
        return $this->tenant_id;
    }

    public function getCompletedAt(): ?Carbon
    {
        return $this->completed_at;
    }

    public function getReceivedAt(): ?Carbon
    {
        return $this->received_at;
    }
}
