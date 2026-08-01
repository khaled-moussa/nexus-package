<?php

namespace App\Nexus\Role\Actions;

use App\Nexus\Role\Models\Role;
use App\Support\Enums\UserPanelEnum;
use Illuminate\Support\Collection;

class GetRolesAction
{
    public function execute(array $with = [], ?UserPanelEnum $panel = null): Collection
    {
        return $this->query($panel)
            ->with($with)
            ->get();
    }

    public function options(?UserPanelEnum $panel = null): array
    {
        return $this->query($panel)
            ->pluck('display_name', 'id')
            ->toArray();
    }

    private function query(?UserPanelEnum $panel)
    {
        return Role::query()
            ->when($panel, fn ($q) => $q->wherePanel($panel));
    }
}