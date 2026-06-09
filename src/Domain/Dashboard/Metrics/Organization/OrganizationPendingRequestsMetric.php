<?php

namespace Nexus\Domain\Dashboard\Metrics\Organization;

use Nexus\Domain\Dashboard\Metrics\AbstractDashboardMetric;
use Nexus\Domain\Request\Models\Request;

class OrganizationPendingRequestsMetric extends AbstractDashboardMetric
{
    public function key(): string
    {
        return 'organization_pending_requests';
    }

    public function calculate(?string $startDate = null, ?string $endDate = null): int
    {
        return $this->applyDateFilter(
            Request::query()->pending(),
            $startDate,
            $endDate
        )->count();
    }
}