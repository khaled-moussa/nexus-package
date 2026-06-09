<?php

namespace Nexus\Domain\Dashboard\Charts\Contract;

interface DashboardChartInterface
{
    public function key(): string;

    public function calculate(?string $startDate = null, ?string $endDate = null): mixed;
}