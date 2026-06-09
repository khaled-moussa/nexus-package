<?php

namespace Nexus\Domain\Dashboard\Metrics\Contract;

interface DashboardMetricInterface
{
    public function key(): string;

    public function calculate(?string $startDate = null, ?string $endDate = null): mixed;
}