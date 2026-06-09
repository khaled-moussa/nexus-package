<?php

namespace Nexus\Domain\Dashboard\Metrics\Workshop;

use Nexus\Domain\Dashboard\Metrics\AbstractDashboardMetric;
use Nexus\Domain\Request\Models\RequestWorkshop;

class WorkshopRequestsMetric extends AbstractDashboardMetric
{
    public function key(): string
    {
        return 'workshop_requests';
    }

    public function calculate(?string $startDate = null, ?string $endDate = null): int
    {
        return $this->applyDateFilter(
            RequestWorkshop::query(),
            $startDate,
            $endDate
        )->count();
    }
}
