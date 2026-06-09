<?php

namespace Nexus\Domain\Dashboard\Metrics;

use Nexus\Domain\Dashboard\Metrics\Contract\DashboardMetricInterface;
use Illuminate\Database\Eloquent\Builder;

abstract class AbstractDashboardMetric implements DashboardMetricInterface
{
    /*
    |--------------------------------------------------------------------------
    | Date Filtering (Shared Logic)
    |--------------------------------------------------------------------------
    */

    protected function applyDateFilter(
        Builder $query,
        ?string $startDate,
        ?string $endDate,
        string $column = 'created_at'
    ): Builder {
        return $query
            ->when($startDate, fn ($q) => $q->whereDate($column, '>=', $startDate))
            ->when($endDate, fn ($q) => $q->whereDate($column, '<=', $endDate));
    }
    
}