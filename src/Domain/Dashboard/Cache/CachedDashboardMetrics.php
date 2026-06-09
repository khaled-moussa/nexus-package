<?php

namespace Nexus\Domain\Dashboard\Cache;

use Nexus\Domain\Dashboard\Dtos\DashboardResultDto;
use Nexus\Domain\Dashboard\Metrics\Contract\DashboardMetricInterface;
use Nexus\Support\Context\AuthContext;
use Illuminate\Support\Facades\Cache;

class CachedDashboardMetrics
{
    private static array $runtimeCache = [];

    public function __construct(
        private readonly iterable $metrics
    ) {}

    public function execute(?string $startDate = null, ?string $endDate = null): DashboardResultDto
    {
        $metrics = iterator_to_array($this->metrics);

        // Build key → metric map, skip what's already in runtime cache
        $keyMap = [];
        foreach ($metrics as $metric) {
            $key = $this->cacheKey($metric, $startDate, $endDate);
            if (!array_key_exists($key, self::$runtimeCache)) {
                $keyMap[$key] = $metric;
            }
        }

        // Fix 3: one batched cache read for everything not in runtime cache
        if (!empty($keyMap)) {
            $cached = Cache::many(array_keys($keyMap));
            $toStore = [];

            foreach ($cached as $key => $value) {
                if ($value === null) {
                    $value = $keyMap[$key]->calculate($startDate, $endDate);
                    $toStore[$key] = $value;
                }
                self::$runtimeCache[$key] = $value;
            }

            if (!empty($toStore)) {
                Cache::putMany($toStore, now()->addMinutes(60));
            }
        }

        $results = [];
        foreach ($metrics as $metric) {
            $key = $this->cacheKey($metric, $startDate, $endDate);
            $results[$metric->key()] = self::$runtimeCache[$key];
        }

        return new DashboardResultDto($results);
    }
    /*
    |--------------------------------------------------------------------------
    | Cache Layer (Clean & Predictable)
    |--------------------------------------------------------------------------
    */

    private function cacheKey(
        DashboardMetricInterface $metric,
        ?string $startDate,
        ?string $endDate
    ): string {
        return 'dashboard:' . $metric->key() . ':' . md5(json_encode([
            'start' => $startDate,
            'end' => $endDate,
            'user' => AuthContext::uuid(),
        ]));
    }
}
