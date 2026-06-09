<?php

namespace Nexus\Domain\Dashboard\Metrics\Workshop;

use Nexus\Domain\Dashboard\Metrics\AbstractDashboardMetric;
use Nexus\Domain\Tenant\Models\Tenant;

class ExternalWorkshopMetric extends AbstractDashboardMetric
{
    public function key(): string
    {
        return 'external_workshops';
    }

    public function calculate(?string $startDate = null, ?string $endDate = null): int
    {
        return $this->applyDateFilter(
            Tenant::query()->externalWorkshop(),
            $startDate,
            $endDate
        )->count();
    }
}