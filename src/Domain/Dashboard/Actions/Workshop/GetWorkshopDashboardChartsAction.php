<?php

namespace Nexus\Domain\Dashboard\Actions\Workshop;

use Nexus\Domain\Dashboard\Cache\CachedDashboardCharts;
use Nexus\Domain\Dashboard\Charts\Workshop\WorkshopRequestOverTimeChart;
use Nexus\Domain\Dashboard\Charts\Workshop\WorkshopRequestProcessingTimeChart;
use Nexus\Domain\Dashboard\Charts\Workshop\WorkshopRequestsByStateChart;

class GetWorkshopDashboardChartsAction
{
    public function execute(): CachedDashboardCharts
    {
        return new CachedDashboardCharts([
            new WorkshopRequestsByStateChart(),
            new WorkshopRequestOverTimeChart(),
            new WorkshopRequestProcessingTimeChart(),
        ]);
    }
}
