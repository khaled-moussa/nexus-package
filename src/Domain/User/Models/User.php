<?php

namespace Nexus\Domain\User\Models;

use Nexus\Domain\Panel\Enums\PanelTypeEnum;
use Nexus\Domain\User\Enums\GenderEnum;
use Nexus\Domain\User\Events\UserCreated;
use Nexus\Domain\User\Models\Builders\UserQueryBuilder;
use Nexus\Domain\User\Models\Concerns\HasUserAttribute;
use Nexus\Domain\User\Models\Concerns\HasUserRelation;
use Nexus\Support\Concerns\HasFormatTimestamp;
use Nexus\Support\Concerns\HasUuid;
use Carbon\Carbon;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName;
use Filament\Models\Contracts\HasTenants;
use Filament\Panel;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements FilamentUser, HasName, HasTenants, MustVerifyEmail
{
    use HasFactory;
    use Notifiable;
    use HasUuid;
    use HasFormatTimestamp;
    use HasUserAttribute;
    use HasUserRelation;

    /*
    |--------------------------------------------------------------------------
    | Events
    |--------------------------------------------------------------------------
    */

    protected $dispatchesEvents = [
        'created' => UserCreated::class,
    ];

    /*
    |--------------------------------------------------------------------------
    | Mass Assignment
    |--------------------------------------------------------------------------
    */

    protected $guarded = [];

    /*
    |--------------------------------------------------------------------------
    | Hidden
    |--------------------------------------------------------------------------
    */

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /*
    |--------------------------------------------------------------------------
    | Casts
    |--------------------------------------------------------------------------
    */

    protected function casts(): array
    {
        return [
            'panel' => PanelTypeEnum::class,
            'gender' => GenderEnum::class,
            'password' => 'hashed',
            'is_active' => 'boolean',
            'email_verified_at' => 'datetime',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Custom Query Builder
    |--------------------------------------------------------------------------
    */

    public function newEloquentBuilder($query): UserQueryBuilder
    {
        return new UserQueryBuilder($query);
    }

    /*
    |--------------------------------------------------------------------------
    | Filament Tenancy
    |--------------------------------------------------------------------------
    */

    public function getTenants(Panel $panel): Collection
    {
        return $this->tenants;
    }

    public function canAccessTenant(Model $tenant): bool
    {
        return $this->tenants->contains($tenant);
    }

    /*
    |--------------------------------------------------------------------------
    | Panel Access
    |--------------------------------------------------------------------------
    */

    public function canAccessPanel(Panel $panel): bool
    {
        return $panel->getId() === PanelTypeEnum::AUTH->value || $this->panel?->value === $panel->getId();
    }

    /*
    |--------------------------------------------------------------------------
    | Getters
    |--------------------------------------------------------------------------
    */

    public function getId(): int
    {
        return (int) $this->id;
    }

    public function getUuid(): string
    {
        return (string) $this->uuid;
    }

    public function getFirstName(): string
    {
        return (string) $this->first_name;
    }

    public function getLastName(): string
    {
        return (string) $this->last_name;
    }

    public function getFullName(): string
    {
        return (string) $this->full_name;
    }

    public function getFilamentName(): string
    {
        return $this->getFullName();
    }

    public function getEmail(): string
    {
        return (string) $this->email;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function getGender(): GenderEnum
    {
        return $this->gender;
    }

    public function getPanel(): ?PanelTypeEnum
    {
        return $this->panel;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function getEmailVerifiedAt(): ?Carbon
    {
        return $this->email_verified_at;
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
    | States
    |--------------------------------------------------------------------------
    */

    public function isAdminPanel(): bool
    {
        return $this->panel === PanelTypeEnum::ADMIN;
    }

    public function isOrganizationPanel(): bool
    {
        return $this->panel === PanelTypeEnum::ORGANIZATION;
    }

    public function isWorkshopPanel(): bool
    {
        return $this->panel === PanelTypeEnum::WORKSHOP;
    }

    public function isActive(): bool
    {
        return (bool) $this->is_active;
    }

    public function hasVerifiedEmail(): bool
    {
        return $this->is_email_Verified;
    }
}
