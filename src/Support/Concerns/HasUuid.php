<?php

namespace Nexus\Support\Concerns;

use Illuminate\Support\Str;

trait HasUuid
{
    /*
    |--------------------------------------------------------------------------
    | Boot Trait
    |--------------------------------------------------------------------------
    */

    protected static function bootHasUuid(): void
    {
        static::creating(function ($model): void {
            if (! $model->hasUuidColumn()) {
                return;
            }

            if (empty($model->uuid)) {
                $model->uuid = strtoupper(
                    Str::substr((string) Str::ulid(), -10)
                );
            }
        });
    }

    /*
    |--------------------------------------------------------------------------
    | Safety check
    |--------------------------------------------------------------------------
    */

    protected function hasUuidColumn(): bool
    {
        return array_key_exists('uuid', $this->attributes)
            || in_array('uuid', $this->getFillable(), true)
            || $this->isFillable('uuid');
    }
}