<?php

namespace Nexus\Domain\Dashboard\Charts\Workshop;

use Nexus\Domain\Dashboard\Charts\AbstractDashboardChartMetric;
use Nexus\Domain\Request\Models\RequestWorkshop;

class WorkshopRequestOverTimeChart extends AbstractDashboardChartMetric
{
    /*
    |--------------------------------------------------------------------------
    | Key
    |--------------------------------------------------------------------------
    */

    public function key(): string
    {
        return 'requestsOverTime';
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
            ->selectRaw('DATE(created_at) as date')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->map(fn ($row) => $this->point(
                label: $row->date,
                value: $row->total,
            ))
            ->toArray();
    }
}