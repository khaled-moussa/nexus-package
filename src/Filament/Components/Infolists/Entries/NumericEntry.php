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
        bool $hiddenLabel = false,
        bool $money = false,
        ?string $currency = 'SAR',
        ?string $locale = null,
        ?string $suffix = null,
        ?string $placeholder = null,
    ): TextEntry {

        return TextEntry::make($name)
            ->hiddenLabel($hiddenLabel)
            ->numeric()
            ->when($label,       fn(TextEntry $entry) => $entry->label(__($label)))
            ->when($money,       fn(TextEntry $entry) => $entry->money($currency, locale: $locale ?? app()->getLocale()))
            ->when($suffix,      fn(TextEntry $entry) => $entry->suffix($suffix))
            ->when($placeholder, fn(TextEntry $entry) => $entry->placeholder(__($placeholder)));
    }

    /*
    |--------------------------------------------------------------------------
    | Variants
    |--------------------------------------------------------------------------
    */

    /*
    |-------------------------
    | Number Variant
    |-------------------------
    */

    public static function number(
        string $name,
        ?string $label = null,
        ?string $suffix = null,
        ?string $placeholder = null,
    ): TextEntry {

        return self::make(
            name: $name,
            label: $label,
            suffix: $suffix,
            placeholder: $placeholder
        );
    }

    /*
    |-------------------------
    | Money Variant
    |-------------------------
    */

    public static function money(
        string $name,
        ?string $label = null,
        string $currency = 'SAR',
        ?string $locale = null,
        ?string $placeholder = null,
    ): TextEntry {

        return self::make(
            name: $name,
            label: $label,
            money: true,
            currency: $currency,
            locale: $locale,
            suffix: " {$currency}",
            placeholder: $placeholder
        );
    }

    /*
    |-------------------------
    | Percentage Variant
    |-------------------------
    */

    public static function percentage(
        string $name,
        ?string $label = null,
        ?string $placeholder = null,
    ): TextEntry {

        return self::make(
            name: $name,
            label: $label,
            suffix: '%',
            placeholder: $placeholder
        );
    }
}
