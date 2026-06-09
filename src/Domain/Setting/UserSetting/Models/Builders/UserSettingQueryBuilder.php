<?php

namespace Nexus\Domain\Setting\UserSetting\Models\Builders;

use Nexus\Support\Enums\ThemeEnum;
use Illuminate\Database\Eloquent\Builder;

class UserSettingQueryBuilder extends Builder
{
    /*
    |--------------------------------------------------------------------------
    | Key Identifiers
    |--------------------------------------------------------------------------
    */

    public function whereId(int $id): static
    {
        return $this->where('id', $id);
    }

    public function whereUserId(int $userId): static
    {
        return $this->where('user_id', $userId);
    }

    /*
    |--------------------------------------------------------------------------
    | Setting Filters
    |--------------------------------------------------------------------------
    */

    public function whereThemeMode(ThemeEnum|string $themeMode): static
    {
        return $this->where('theme_mode',  $themeMode instanceof ThemeEnum ? $themeMode->value : $themeMode);
    }

    public function whereLanguage(string $language): static
    {
        return $this->where('language', $language);
    }

    public function whereTimezone(string $timezone): static
    {
        return $this->where('timezone', $timezone);
    }

    public function whereSiteNotificationActive(bool $active = true): static
    {
        return $this->where('site_notification_active', $active);
    }

    public function whereEmailNotificationActive(bool $active = true): static
    {
        return $this->where('email_notification_active', $active);
    }

    /*
    |--------------------------------------------------------------------------
    | Date Scopes
    |--------------------------------------------------------------------------
    */

    public function latestFirst(): static
    {
        return $this->orderByDesc('created_at');
    }

    public function oldestFirst(): static
    {
        return $this->orderBy('created_at');
    }
}
