<?php

namespace Nexus\Domain\Dashboard\Actions\Workshop;

use Nexus\Domain\Dashboard\Cache\CachedDashboardMetrics;
use Nexus\Domain\Dashboard\Metrics\Workshop\WorkshopPendingRequestsMetric;
use Nexus\Domain\Dashboard\Metrics\Workshop\WorkshopRequestsMetric;
use Nexus\Domain\Dashboard\Metrics\Workshop\WorkshopUsersMetric;

class GetWorkshopDashboardMetricsAction
{
    public function execute(): CachedDashboardMetrics
    {
        return new CachedDashboardMetrics([
            app(WorkshopUsersMetric::class),
            app(WorkshopRequestsMetric::class),
            app(WorkshopPendingRequestsMetric::class),
        ]);
    }
}