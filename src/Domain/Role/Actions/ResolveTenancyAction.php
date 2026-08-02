<?php

namespace Nexus\Domain\Role\Actions;

use BezhanSalleh\FilamentShield\Support\Utils;
use Illuminate\Support\Arr;

class ResolveTenancyAction
{
    public function execute(array $data): ?array
    {
        if (! Utils::isTenancyEnabled()) {
            return null;
        }

        $tenantKey = Utils::getTenantModelForeignKey();

        if (! Arr::has($data, $tenantKey)) {
            return null;
        }

        return [
            $tenantKey => $data[$tenantKey],
        ];
    }
}
