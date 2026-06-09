<?php

namespace Nexus\Domain\Dashboard\Metrics\Organization;

use Nexus\Domain\Dashboard\Metrics\AbstractDashboardMetric;
use Nexus\Domain\User\Models\User;
use Nexus\Support\Context\AuthContext;

class OrganizationUsersMetric extends AbstractDashboardMetric
{
    public function key(): string
    {
        return 'organization_users';
    }

    public function calculate(?string $startDate = null, ?string $endDate = null): int
    {
        return $this->applyDateFilter(
            User::query()->whereNotUser(AuthContext::id()),
            $startDate,
            $endDate
        )->count();
    }
}