<?php

namespace App\Nexus\Role\Models;

use App\Nexus\Role\Models\Builders\RoleQueryBuilder;
use App\Nexus\Role\Models\Concerns\HasRoleRelation;
use App\Nexus\Role\Models\Concerns\HasRoleScope;
use App\Support\Enums\UserPanelEnum;
use Nexus\Domain\Panel\Enums\PanelTypeEnum;
use Nexus\Support\Concerns\HasFormatTimestamp;
use Spatie\Permission\Models\Role as BaseRole;

class Role extends BaseRole
{
    use HasRoleScope;
    use HasRoleRelation;
    use HasFormatTimestamp;

    /*
    |--------------------------------------------------------------------------
    | Properties
    |--------------------------------------------------------------------------
    */

    protected $guarded = [];

    protected $casts = [
        'panel' => PanelTypeEnum::class,
    ];

    /*
    |--------------------------------------------------------------------------
    | Custom Query Builder
    |--------------------------------------------------------------------------
    */

    public function newEloquentBuilder($query): RoleQueryBuilder
    {
        return new RoleQueryBuilder($query);
    }

    /*
    |--------------------------------------------------------------------------
    | Getters
    |--------------------------------------------------------------------------
    */

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getGuardName(): string
    {
        return $this->guard_name;
    }

    public function getPanel(): PanelTypeEnum
    {
        return $this->panel;
    }

    public function getTenantId(): ?int
    {
        return $this->tenant_id;
    }

    public function getTenantModel(): ?object
    {
        return $this->tenant;
    }
}
