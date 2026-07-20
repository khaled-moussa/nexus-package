<?php

namespace Nexus\Support\Concerns;

use Nexus\Support\Context\AuthContext;
use Carbon\Carbon;

trait HasFormatTimestamp
{
    /*
    |--------------------------------------------------------------------------
    | Formatted Timestamps
    |--------------------------------------------------------------------------
    */

    public function getCreatedAtFormattedAttribute(): ?string
    {
        return $this->formatTimestamp($this->created_at);
    }

    public function getUpdatedAtFormattedAttribute(): ?string
    {
        return $this->formatTimestamp($this->updated_at);
    }


    /*
    |--------------------------------------------------------------------------
    | Formatter
    |--------------------------------------------------------------------------
    */

    protected function formatTimestamp(Carbon|string|null $value): ?string
    {
        if (! $value) {
            return null;
        }

        $date = $value instanceof Carbon
            ? $value->copy()
            : Carbon::parse($value);

        return $date
            ->timezone($this->getUserTimezone())
            ->format('d M Y g:i A');
    }

    /*
    |--------------------------------------------------------------------------
    | Timezone
    |--------------------------------------------------------------------------
    */

    protected function getUserTimezone(): string
    {
        return AuthContext::timezone() ?? config('app.timezone');
    }
}
