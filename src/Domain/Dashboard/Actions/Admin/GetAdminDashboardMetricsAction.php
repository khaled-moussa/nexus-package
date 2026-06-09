<?php

namespace Nexus\Domain\Dashboard\Actions\Admin;

use Nexus\Domain\Dashboard\Cache\CachedDashboardMetrics;
use Nexus\Domain\Dashboard\Metrics\Admin\AdminMetric;
use Nexus\Domain\Dashboard\Metrics\Organization\OrganizationMetric;
use Nexus\Domain\Dashboard\Metrics\Organization\OrganizationRequestsMetric;
use Nexus\Domain\Dashboard\Metrics\Workshop\ExternalWorkshopMetric;
use Nexus\Domain\Dashboard\Metrics\Workshop\InternalWorkshopMetric;
use Nexus\Domain\Dashboard\Metrics\Workshop\WorkshopRequestsMetric;

class GetAdminDashboardMetricsAction
{
    public function execute(): CachedDashboardMetrics
    {
        return new CachedDashboardMetrics([
            app(AdminMetric::class),
            app(OrganizationMetric::class),
            app(InternalWorkshopMetric::class),
            app(ExternalWorkshopMetric::class),
            app(OrganizationRequestsMetric::class),
            app(WorkshopRequestsMetric::class),
        ]);
    }
}