<?php

namespace Nexus\Domain\Dashboard\Metrics\Organization;

use Nexus\Domain\Dashboard\Metrics\AbstractDashboardMetric;
use Nexus\Domain\Tenant\Models\Tenant;

class OrganizationMetric extends AbstractDashboardMetric
{
    public function key(): string
    {
        return 'organizations';
    }

    public function calculate(?string $startDate = null, ?string $endDate = null): int
    {
        return $this->applyDateFilter(
            Tenant::query()->organization(),
            $startDate,
            $endDate
        )->count();
    }
}