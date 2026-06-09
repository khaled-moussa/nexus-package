<?php

namespace Nexus\Domain\Dashboard\Actions\Organization;

use Nexus\Domain\Dashboard\Cache\CachedDashboardCharts;
use Nexus\Domain\Dashboard\Charts\Organization\OrganizationRequestsByStateChart;
use Nexus\Domain\Dashboard\Charts\Organization\OrganizationRequestOverTimeChart;
use Nexus\Domain\Dashboard\Charts\Organization\OrganizationRequestProcessingTimeChart;

class GetOrganizationDashboardChartsAction
{
    public function execute(): CachedDashboardCharts
    {
        return new CachedDashboardCharts([
            new OrganizationRequestsByStateChart(),
            new OrganizationRequestOverTimeChart(),
            new OrganizationRequestProcessingTimeChart(),
        ]);
    }
}
