<?php

namespace Nexus\Support\Enums;

enum LanguageEnum: string
{
    case AR = 'ar';
    case EN = 'en';

    /*
    |--------------------------------------------------------------------------
    | Labels
    |--------------------------------------------------------------------------
    */

    public function label(): string
    {
        return match ($this) {
            self::AR => 'العربية',
            self::EN => 'English',
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