<?php

namespace Nexus\Domain\Dashboard\Charts\Workshop;

use Nexus\Domain\Dashboard\Charts\AbstractDashboardChartMetric;
use Nexus\Domain\Request\Models\RequestWorkshop;

class WorkshopRequestsByStateChart extends AbstractDashboardChartMetric
{
    /*
    |--------------------------------------------------------------------------
    | Key
    |--------------------------------------------------------------------------
    */

    public function key(): string
    {
        return 'requestsByState';
    }

    /*
    |--------------------------------------------------------------------------
    | Calculate
    |--------------------------------------------------------------------------
    */

    public function calculate(
        ?string $startDate = null,
        ?string $endDate = null,
    ): array {
        return $this->applyDateFilter(
            RequestWorkshop::query(),
            $startDate,
            $endDate,
        )
            ->select('request_state')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('request_state')
            ->get()
            ->map(fn ($row) => [
                'label' => $row->request_state->label(),
                'value' => $row->total,
                'color' => $row->request_state->colorChart(),
            ])
            ->values()
            ->toArray();
    }
}