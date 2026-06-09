<?php

namespace Nexus\Filament\Components\Infolists\Entries;

use Filament\Infolists\Components\TextEntry;

class NumericEntry
{
    /*
    |--------------------------------------------------------------------------
    | Base Builder
    |--------------------------------------------------------------------------
    */

    public static function make(
        string $name,
        ?string $label = null,
        bool $money = false,
        ?string $currency = 'SAR',
        ?string $locale = null,
        ?string $suffix = null,
    ): TextEntry {

        return TextEntry::make($name)
            ->label($label ? __($label) : null)
            ->when($money, fn($e) => $e->money($currency, locale: $locale ?? app()->getLocale()))
            ->when($suffix, fn($e) => $e->suffix($suffix))
            ->numeric()
            ->placeholder('—');
    }

    /*
    |--------------------------------------------------------------------------
    | Number
    |--------------------------------------------------------------------------
    */

    public static function number(
        string $name,
        ?string $label = null,
        ?string $suffix = null,
    ): TextEntry {

        return self::make(
            name: $name,
            label: $label,
            suffix: $suffix,
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Money
    |--------------------------------------------------------------------------
    */

    public static function money(
        string $name,
        ?string $label = null,
        string $currency = 'SAR',
        ?string $locale = null,
    ): TextEntry {

        return self::make(
            name: $name,
            label: $label,
            money: true,
            currency: $currency,
            locale: $locale,
            suffix: " {$currency}",
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Percentage
    |--------------------------------------------------------------------------
    */

    public static function percentage(
        string $name,
        ?string $label = null,
    ): TextEntry {

        return self::make(
            name: $name,
            label: $label,
            suffix: '%',
        );
    }
}
