<?php

namespace Nexus\Domain\Dashboard\Charts\Admin;

use Nexus\Domain\Dashboard\Charts\AbstractDashboardChartMetric;
use Nexus\Domain\Request\Models\Request;

class RequestProcessingTimeChart extends AbstractDashboardChartMetric
{
    /*
    |--------------------------------------------------------------------------
    | Key
    |--------------------------------------------------------------------------
    */

    public function key(): string
    {
        return 'requestProcessingTime';
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
            ->whereNotNull('completed_at')
            ->selectRaw('DATE(created_at) as date')
            ->selectRaw('AVG(TIMESTAMPDIFF(HOUR, created_at, completed_at)) as avg_hours')
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->map(fn ($row) => $this->point(
                label: $row->date,
                value: round($row->avg_hours, 2),
            ))
            ->toArray();
    }
}