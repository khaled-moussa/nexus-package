<?php

namespace App\Nexus\Permission\Models;

use App\Nexus\Permission\Models\Builders\PermissionQueryBuilder;
use App\Nexus\Permission\Models\Observers\PermissionObserver;
use App\Nexus\Permission\Models\Concerns\HasPermissionRelation;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Spatie\Permission\Models\Permission as BasePermission;

#[ObservedBy([PermissionObserver::class])]
class Permission extends BasePermission
{
    use HasPermissionRelation;

    /*
    --------------------------------------------------------------------------
    |  Properties
    --------------------------------------------------------------------------
    */
    protected $guarded = [];

    /*
    --------------------------------------------------------------------------
    | Custom Query Builder
    --------------------------------------------------------------------------
    */

    public function newEloquentBuilder($query)
    {
        return new PermissionQueryBuilder($query);
    }

    /*
    --------------------------------------------------------------------------
    |  Getters
    --------------------------------------------------------------------------
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

    public function getPanel(): string
    {
        return $this->panel;
    }
}
