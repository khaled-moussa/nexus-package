<?php

namespace Nexus\Domain\Dashboard\Charts\Admin;

use Nexus\Domain\Dashboard\Charts\AbstractDashboardChartMetric;
use Nexus\Domain\Request\Models\Request;

class RequestsByStateChart extends AbstractDashboardChartMetric
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
            Request::query(),
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