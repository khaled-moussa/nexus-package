<?php

namespace Nexus\Domain\Dashboard\Charts\Admin;

use Nexus\Domain\Dashboard\Charts\AbstractDashboardChartMetric;
use Nexus\Domain\Tenant\Models\Tenant;
use Illuminate\Database\Eloquent\Builder;

class RequestsByOrganizationChart extends AbstractDashboardChartMetric
{
    /*
    |--------------------------------------------------------------------------
    | Key
    |--------------------------------------------------------------------------
    */

    public function key(): string
    {
        return 'requestsByOrganization';
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
        return Tenant::query()
            ->organization()
            ->withCount([
                'organizationRequests' => fn (Builder $query) => $this->applyDateFilter(
                    $query,
                    $startDate,
                    $endDate,
                ),
            ])
            ->orderByDesc('organization_requests_count')
            ->limit(10)
            ->get()
            ->map(fn (Tenant $tenant) => $this->point(
                label: $tenant->name,
                value: $tenant->organization_requests_count,
            ))
            ->toArray();
    }
}