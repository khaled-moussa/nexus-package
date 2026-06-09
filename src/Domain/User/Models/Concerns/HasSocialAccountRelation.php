<?php

namespace Nexus\Domain\User\Models\Concerns;

use Nexus\Domain\User\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasSocialAccountRelation
{
    /*
    |--------------------------------------------------------------------------
    | Relations
    |--------------------------------------------------------------------------
    */

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
