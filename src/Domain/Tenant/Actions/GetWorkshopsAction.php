<?php

namespace Nexus\Domain\Tenant\Actions;

use Nexus\Domain\Tenant\Models\Tenant;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class GetWorkshopsAction
{
    /*
    |--------------------------------------------------------------------------
    | Execute
    |--------------------------------------------------------------------------
    */

    public function execute(): Collection
    {
        return $this->query()->get();
    }

    public function internal(): Collection
    {
        return $this->internalQuery()->get();
    }

    public function external(): Collection
    {
        return $this->externalQuery()->get();
    }

    /*
    |--------------------------------------------------------------------------
    | Options
    |--------------------------------------------------------------------------
    */

    public function options(): array
    {
        return [
            __('Internal Workshops') => $this->internalQuery()
                ->pluck('name', 'id')
                ->toArray(),

            __('External Workshops') => $this->externalQuery()
                ->pluck('name', 'id')
                ->toArray(),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Queries
    |--------------------------------------------------------------------------
    */

    private function query(): Builder
    {
        return Tenant::query();
    }

    private function internalQuery(): Builder
    {
        return $this->query()->internalWorkshop();
    }

    private function externalQuery(): Builder
    {
        return $this->query()->externalWorkshop();
    }
}
