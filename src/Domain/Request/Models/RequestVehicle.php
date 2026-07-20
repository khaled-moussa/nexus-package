<?php

namespace Nexus\Domain\Request\Models;

use Nexus\Domain\Request\Models\Builders\RequestVehicleQueryBuilder;
use Nexus\Domain\Request\Models\Concerns\HasRequestVehicleRelation;
use Nexus\Domain\Request\Models\Concerns\HasRequestVehicleAttribute;
use Nexus\Domain\Request\Models\States\VehicleState\VehicleStates;
use Nexus\Domain\Request\Enums\VehicleServiceTypeEnum;
use Nexus\Support\Concerns\HasUuid;
use Nexus\Support\Models\BaseModel;
use Spatie\ModelStates\HasStates;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class RequestVehicle extends BaseModel
{
    use HasFactory;
    use HasStates;
    use HasUuid;
    use HasRequestVehicleAttribute;
    use HasRequestVehicleRelation;

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
            'vehicle_state'     => VehicleStates::class,
            'service_type'      => VehicleServiceTypeEnum::class,
            'can_edit'          => 'boolean',
            'created_at'        => 'datetime',
            'updated_at'        => 'datetime',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Builder
    |--------------------------------------------------------------------------
    */

    public function newEloquentBuilder($query): RequestVehicleQueryBuilder
    {
        return new RequestVehicleQueryBuilder($query);
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

    public function getManufacturer(): string
    {
        return $this->manufacturer;
    }

    public function getModel(): string
    {
        return $this->model;
    }

    public function getModelYear(): int
    {
        return $this->model_year;
    }

    public function getPlateNumber(): string
    {
        return $this->plate_number;
    }

    public function getVinNumber(): string
    {
        return $this->vin_number;
    }

    public function getKilometers(): int
    {
        return $this->kilometers;
    }

    public function getIssueDescription(): string
    {
        return $this->issue_description;
    }

    public function getComments(): ?string
    {
        return $this->comments;
    }

    public function getArea(): ?string
    {
        return $this->area;
    }

    public function getVehicleState(): VehicleStates
    {
        return $this->vehicle_state;
    }

    public function canEdit(): bool
    {
        return $this->can_edit;
    }

    public function getQuotationNotes(): ?string
    {
        return $this->quotation_notes;
    }

    public function getServiceType(): VehicleServiceTypeEnum
    {
        return $this->service_type;
    }

    public function getCountryId(): ?int
    {
        return $this->country_id;
    }

    public function getCityId(): ?int
    {
        return $this->city_id;
    }

    public function getRequestId(): int
    {
        return $this->request_id;
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
