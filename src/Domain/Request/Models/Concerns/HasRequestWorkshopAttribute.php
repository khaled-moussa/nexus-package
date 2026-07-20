<?php

namespace Nexus\Domain\Request\Models\Concerns;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait HasRequestWorkshopAttribute
{
    /*
    |--------------------------------------------------------------------------
    | Computed Attributes
    |--------------------------------------------------------------------------
    */

    protected function completedAtFormatted(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->formatTimestamp($this->completed_at),
        );
    }

    protected function receivedAtFormatted(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->formatTimestamp($this->received_at),
        );
    }

    protected function deliveredAtFormatted(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->formatTimestamp($this->delivered_at),
        );
    }
}
