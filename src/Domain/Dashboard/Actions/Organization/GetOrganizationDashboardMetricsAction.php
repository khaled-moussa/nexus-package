<?php

namespace Nexus\Domain\Dashboard\Actions\Organization;

use Nexus\Domain\Dashboard\Cache\CachedDashboardMetrics;
use Nexus\Domain\Dashboard\Metrics\Organization\OrganizationPendingRequestsMetric;
use Nexus\Domain\Dashboard\Metrics\Organization\OrganizationRequestsMetric;
use Nexus\Domain\Dashboard\Metrics\Organization\OrganizationUsersMetric;

class GetOrganizationDashboardMetricsAction
{
    public function execute(): CachedDashboardMetrics
    {
        return new CachedDashboardMetrics([
            app(OrganizationUsersMetric::class),
            app(OrganizationRequestsMetric::class),
            app(OrganizationPendingRequestsMetric::class),
        ]);
    }
}