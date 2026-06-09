<?php

namespace Nexus\Domain\Setting\UserSetting\Models;

use Nexus\Domain\Setting\UserSetting\Models\Builders\UserSettingQueryBuilder;
use Nexus\Domain\Setting\UserSetting\Models\Concerns\HasUserSettingRelation;
use Nexus\Support\Concerns\HasUuid;
use Nexus\Support\Enums\ThemeEnum;
use Nexus\Support\Models\BaseModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserSetting extends BaseModel
{
    use HasFactory;
    use HasUuid;
    use HasUserSettingRelation;

    /*
    |--------------------------------------------------------------------------
    | Mass Assignment
    |--------------------------------------------------------------------------
    */

    protected $guarded = [];

    /*
    |--------------------------------------------------------------------------
    | Casts
    |--------------------------------------------------------------------------
    */

    protected function casts(): array
    {
        return [
            'theme'       => ThemeEnum::class,
            'created_at'  => 'datetime',
            'updated_at'  => 'datetime',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Builder
    |--------------------------------------------------------------------------
    */

    public function newEloquentBuilder($query): UserSettingQueryBuilder
    {
        return new UserSettingQueryBuilder($query);
    }

    /*
    |--------------------------------------------------------------------------
    | Getters
    |--------------------------------------------------------------------------
    */

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function getTheme(): ThemeEnum
    {
        return $this->theme;
    }

    public function getLanguage(): string
    {
        return $this->language;
    }

    public function getTimezone(): string
    {
        return $this->timezone;
    }

    public function isSiteNotificationActive(): bool
    {
        return (bool) $this->site_notification_active;
    }

    public function isEmailNotificationActive(): bool
    {
        return (bool) $this->email_notification_active;
    }

    public function getCreatedAt(): ?Carbon
    {
        return $this->created_at;
    }

    public function getUpdatedAt(): ?Carbon
    {
        return $this->updated_at;
    }
}
