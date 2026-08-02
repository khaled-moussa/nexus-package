<?php

namespace Nexus\Domain\Role\Actions;

use Nexus\Domain\Panel\Enums\PanelTypeEnum;
use Nexus\Domain\Role\Models\Role;
use Illuminate\Support\Collection;

class GetRolesAction
{
    public function execute(array $with = [], ?PanelTypeEnum $panel = null): Collection
    {
        return $this->query($panel)
            ->with($with)
            ->get();
    }

    public function options(?PanelTypeEnum $panel = null): array
    {
        return $this->query($panel)
            ->pluck('display_name', 'id')
            ->toArray();
    }

    private function query(?PanelTypeEnum $panel)
    {
        return Role::query()
            ->when($panel, fn ($q) => $q->wherePanel($panel));
    }
}