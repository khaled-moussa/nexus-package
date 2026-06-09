<?php

namespace Nexus\Domain\Setting\UserSetting\Models\Concerns;

use Nexus\Domain\User\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasUserSettingRelation
{
    /*
    |--------------------------------------------------------------------------
    | Core Relations
    |--------------------------------------------------------------------------
    */

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
