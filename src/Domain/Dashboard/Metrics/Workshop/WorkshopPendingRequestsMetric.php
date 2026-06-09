<?php

namespace Nexus\Domain\Dashboard\Metrics\Workshop;

use Nexus\Domain\Dashboard\Metrics\AbstractDashboardMetric;
use Nexus\Domain\Request\Models\RequestWorkshop;

class WorkshopPendingRequestsMetric extends AbstractDashboardMetric
{
    public function key(): string
    {
        return 'workshop_pending_requests';
    }

    public function calculate(?string $startDate = null, ?string $endDate = null): int
    {
        return $this->applyDateFilter(
            RequestWorkshop::query()->pending(),
            $startDate,
            $endDate
        )->count();
    }
}