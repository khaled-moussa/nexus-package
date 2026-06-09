<?php

namespace Nexus\Domain\Dashboard\Charts;

use Nexus\Domain\Dashboard\Charts\Contract\DashboardChartInterface;
use Illuminate\Database\Eloquent\Builder;

abstract class AbstractDashboardChartMetric implements DashboardChartInterface
{
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

    protected function point(string $label, int|float $value): array
    {
        return [
            'label' => $label,
            'value' => $value,
        ];
    }
}