<?php

namespace Nexus\Domain\Dashboard\Actions\Admin;

use Nexus\Domain\Dashboard\Cache\CachedDashboardCharts;
use Nexus\Domain\Dashboard\Charts\Admin\RequestsByOrganizationChart;
use Nexus\Domain\Dashboard\Charts\Organization\OrganizationRequestsByStateChart;
use Nexus\Domain\Dashboard\Charts\Organization\OrganizationRequestOverTimeChart;
use Nexus\Domain\Dashboard\Charts\Organization\OrganizationRequestProcessingTimeChart;

class GetAdminDashboardChartsAction
{
    public function execute(): CachedDashboardCharts
    {
        return new CachedDashboardCharts([
            new OrganizationRequestsByStateChart(),
            new OrganizationRequestOverTimeChart(),
            new RequestsByOrganizationChart(),
            new OrganizationRequestProcessingTimeChart(),
        ]);
    }
}
