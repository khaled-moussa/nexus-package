<?php

namespace Nexus\Domain\Dashboard\Metrics\Admin;

use Nexus\Domain\Dashboard\Metrics\AbstractDashboardMetric;
use Nexus\Domain\User\Models\User;

class AdminMetric extends AbstractDashboardMetric
{
    public function key(): string
    {
        return 'admins';
    }

    public function calculate(?string $startDate = null, ?string $endDate = null): int
    {
        return $this->applyDateFilter(
            User::query()->admin(),
            $startDate,
            $endDate
        )->count();
    }
}
