<?php

namespace Nexus\Support\Context;

use Nexus\Domain\Panel\Enums\PanelTypeEnum;
use Filament\Facades\Filament;
use Filament\Panel;

class PanelContext
{
    private static ?Panel $cachedPanel = null;

    /*
    |--------------------------------------------------------------------------
    | Resolver
    |--------------------------------------------------------------------------
    */

    private static function resolvePanel(): ?Panel
    {
        return self::$cachedPanel ??= Filament::getCurrentPanel();
    }

    private static function id(): ?string
    {
        return self::resolvePanel()?->getId();
    }

    /*
    |--------------------------------------------------------------------------
    | Current Panel
    |--------------------------------------------------------------------------
    */

    public static function panel(): ?Panel
    {
        return self::resolvePanel();
    }

    public static function name(): ?string
    {
        return self::id();
    }

    /*
    |--------------------------------------------------------------------------
    | State Checks
    |--------------------------------------------------------------------------
    */

    public static function isAuth(): bool
    {
        return self::id() === PanelTypeEnum::AUTH->value;
    }

    public static function isAdmin(): bool
    {
        return self::id() === PanelTypeEnum::ADMIN->value;
    }

    public static function isOrganization(): bool
    {
        return self::id() === PanelTypeEnum::ORGANIZATION->value;
    }

    public static function isWorkshop(): bool
    {
        return self::id() === PanelTypeEnum::WORKSHOP->value;
    }

    /*
    |--------------------------------------------------------------------------
    | Generic Check
    |--------------------------------------------------------------------------
    */

    public static function is(string $panel): bool
    {
        return self::id() === $panel;
    }
}
