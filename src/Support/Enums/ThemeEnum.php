<?php

namespace Nexus\Support\Enums;

enum ThemeEnum: string
{
    case LIGHT = 'light';
    case DARK = 'dark';
    case SYSTEM = 'system';

    /*
    |--------------------------------------------------------------------------
    | Labels
    |--------------------------------------------------------------------------
    */

    public function label(): string
    {
        return match ($this) {
            self::LIGHT => __('Light'),
            self::DARK => __('Dark'),
            self::SYSTEM => __('System'),
        };
    }

    /*
    |--------------------------------------------------------------------------
    | Options
    |--------------------------------------------------------------------------
    */

    public static function options(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn(self $theme) => [
                $theme->value => $theme->label(),
            ])
            ->all();
    }
}