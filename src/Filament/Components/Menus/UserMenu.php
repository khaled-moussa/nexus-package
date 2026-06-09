<?php

namespace Nexus\Filament\Components\Menus;

use Nexus\Filament\Pages\Settings\GeneralSetting;
use Filament\Navigation\MenuItem;
use Filament\Support\Icons\Heroicon;

class UserMenu
{
    /*
    |--------------------------------------------------------------------------
    | Public API
    |--------------------------------------------------------------------------
    */

    public static function adminMenu(): array
    {
        return [
            self::settingsItem(),
        ];
    }

    public static function organizationMenu(): array
    {
        return [
            self::settingsItem(),
        ];
    }

    public static function workshopMenu(): array
    {
        return [
            self::settingsItem(),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Shared Menu Items
    |--------------------------------------------------------------------------
    */

    private static function settingsItem(): MenuItem
    {
        return MenuItem::make('settings')
            ->label(__('Settings'))
            ->icon(Heroicon::AdjustmentsHorizontal)
            ->url(fn(): string => GeneralSetting::getUrl());
    }
}
