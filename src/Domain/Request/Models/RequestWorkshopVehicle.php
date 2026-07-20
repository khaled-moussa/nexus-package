<?php

namespace Nexus\Domain\Request\Models;

use Nexus\Domain\Request\Models\Builders\RequestWorkshopVehicleQueryBuilder;
use Nexus\Domain\Request\Models\Concerns\HasRequestWorkshopVehicleAttribute;
use Nexus\Domain\Request\Models\Concerns\HasRequestWorkshopVehicleRelation;
use Nexus\Domain\Request\Models\States\VehicleState\VehicleStates;
use Nexus\Support\Concerns\HasUuid;
use Spatie\ModelStates\HasStates;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Carbon\Carbon;

class RequestWorkshopVehicle extends Pivot
{
    use HasFactory;
    use HasUuid;
    use HasStates;
    use HasRequestWorkshopVehicleAttribute;
    use HasRequestWorkshopVehicleRelation;

    /*
    |--------------------------------------------------------------------------
    | Mass Assignment
    |--------------------------------------------------------------------------
    */

    protected $guarded = [];

    protected $table = 'request_workshop_vehicles';

    /*
    |--------------------------------------------------------------------------
    | Casts
    |--------------------------------------------------------------------------
    */

    protected function casts(): array
    {
        return [
            'vehicle_state'        => VehicleStates::class,
            'created_at'           => 'datetime',
            'updated_at'           => 'datetime',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Builder
    |--------------------------------------------------------------------------
    */

    public function newEloquentBuilder($query): RequestWorkshopVehicleQueryBuilder
    {
        return new RequestWorkshopVehicleQueryBuilder($query);
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

    public function getVehicleState(): VehicleStates
    {
        return $this->vehicle_state;
    }

    public function getComments(): ?string
    {
        return $this->comments;
    }

    public function getRequestWorkshopId(): int
    {
        return $this->request_workshop_id;
    }

    public function getRequestVehicleId(): int
    {
        return $this->request_vehicle_id;
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

    public function inProgress(): bool
    {
        return $this->is_inProgress;
    }

    public function completed(): bool
    {
        return $this->is_completed;
    }

    public function received(): bool
    {
        return $this->is_received;
    }

    public function delivered(): bool
    {
        return $this->is_delivered;
    }

    public function rejected(): bool
    {
        return $this->is_rejected;
    }
}
