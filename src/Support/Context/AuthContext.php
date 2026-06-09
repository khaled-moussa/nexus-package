<?php

namespace Nexus\Support\Context;

use Nexus\Domain\Setting\UserSetting\Models\UserSetting;
use Nexus\Domain\Tenant\Models\Tenant;
use Nexus\Domain\User\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthContext
{
    private static ?UserSetting $settingsCache = null;

    /*
    |--------------------------------------------------------------------------
    | User
    |--------------------------------------------------------------------------
    */

    public static function user(): ?User
    {
        return Auth::user();
    }

    public static function id(): ?int
    {
        return Auth::id();
    }

    public static function uuid(): ?string
    {
        return self::user()?->getUuid();
    }

    /*
    |--------------------------------------------------------------------------
    | Tenancy
    |--------------------------------------------------------------------------
    */

    public static function tenant(): ?Tenant
    {
        return filament()->getTenant();
    }

    public static function tenantId(): ?int
    {
        return self::tenant()?->getId();
    }

    public static function tenantUuid(): ?string
    {
        return self::tenant()?->getUuid();
    }

    public static function tenantSlug(): ?string
    {
        return self::tenant()?->getUuid();
    }

    /*
    |--------------------------------------------------------------------------
    | State
    |--------------------------------------------------------------------------
    */

    public static function check(): bool
    {
        return Auth::check();
    }

    public static function guest(): bool
    {
        return Auth::guest();
    }

    /*
    |--------------------------------------------------------------------------
    | Authorization
    |--------------------------------------------------------------------------
    */

    public static function can(string $permission, mixed $record = null): bool
    {
        return Auth::user()?->can($permission, $record) ?? false;
    }

    /*
    |--------------------------------------------------------------------------
    | Settings (NEW)
    |--------------------------------------------------------------------------
    */

    public static function settings(): ?UserSetting
    {
        if (self::$settingsCache) {
            return self::$settingsCache;
        }

        $user = self::user();

        if (! $user) {
            return null;
        }

        return self::$settingsCache = $user->settings;
    }

    public static function settingKey(string $key, mixed $default = null): mixed
    {
        $settings = self::settings();

        if (! $settings) {
            return $default;
        }

        return data_get($settings, $key, $default);
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers (NEW)
    |--------------------------------------------------------------------------
    */

    public static function theme(): string
    {
        return self::settingKey('theme', 'system');
    }

    public static function language(): string
    {
        return self::settingKey('language', config('app.locale'));
    }

    public static function timezone(): string
    {
        return self::settingKey('timezone', config('app.timezone'));
    }
}
