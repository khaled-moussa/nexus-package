<?php

namespace Nexus\Role\Models\Concerns;

use Illuminate\Database\Eloquent\Relations\MorphTo;

trait HasRoleRelation
{
    /*
    |--------------------------------------------------------------------------
    | Core Relations
    |--------------------------------------------------------------------------
    */

    public function tenant(): MorphTo
    {
        return $this->morphTo();
    }
}