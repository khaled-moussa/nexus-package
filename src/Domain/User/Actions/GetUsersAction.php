<?php

namespace Nexus\Domain\User\Actions;

use Nexus\Domain\User\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class GetUsersAction
{
    /*
    |--------------------------------------------------------------------------
    | Admins
    |--------------------------------------------------------------------------
    */

    public function admins(): Collection
    {
        return $this->baseQuery()
            ->admin()
            ->get();
    }

    /*
    |--------------------------------------------------------------------------
    | Organizations
    |--------------------------------------------------------------------------
    */

    public function organizations(): Collection
    {
        return $this->baseQuery()
            ->organization()
            ->get();
    }

    /*
    |--------------------------------------------------------------------------
    | Workshops
    |--------------------------------------------------------------------------
    */

    public function workshops(): Collection
    {
        return $this->baseQuery()
            ->workshop()
            ->get();
    }

    /*
    |--------------------------------------------------------------------------
    | Base
    |--------------------------------------------------------------------------
    */

    public function baseQuery(): Builder
    {
        return User::query()
            ->withoutGlobalScopes();
    }
}
