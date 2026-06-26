<?php

namespace Nexus\Filament\Components\Infolists\Entries;

use Filament\Infolists\Components\TextEntry;
use Filament\Support\Colors\Color;
use Closure;

class StatusEntry
{
    /*
    |---------------------------------------------------------------------------------------------------------------------------
    | Base Builder
    |---------------------------------------------------------------------------------------------------------------------------
    */

    public static function make(
        string $name,
        ?string $label = null,
        bool $hiddenLabel = false,
        bool $badge = true,
        ?string $placeholder = null,
    ): TextEntry {

        return TextEntry::make($name)
            ->hiddenLabel($hiddenLabel)
            ->when($label,       fn(TextEntry $entry) => $entry->label(__($label)))
            ->when($badge,       fn(TextEntry $entry) => $entry->badge())
            ->when($placeholder, fn(TextEntry $entry) => $entry->placeholder(__($placeholder)));
    }

    /*
    |--------------------------------------------------------------------------
    | Boolean Variant
    |--------------------------------------------------------------------------
    */

    public static function boolean(
        string $name,
        ?string $label = null,
        bool $hiddenLabel = false,
        ?Closure $state = null,
    ): TextEntry {

        return self::make($name, $label, $hiddenLabel)
            ->when(!is_null($state), fn(TextEntry $entry) => $entry->state($state))
            ->when(!is_null($state), fn(TextEntry $entry) => $entry->formatStateUsing(fn($state) => (bool) $state ? __('Active') : __('Inactive')))
            ->when(!is_null($state), fn(TextEntry $entry) => $entry->color(fn($state) => (bool) $state ? Color::Green  : Color::Rose));
    }

    /*
    |--------------------------------------------------------------------------
    | Custom Variant
    |--------------------------------------------------------------------------
    */

    public static function custom(
        string $name,
        Closure $formatUsing,
        ?Closure $color = null,
        ?string $label = null,
        bool $hiddenLabel = false,
        ?Closure $state = null,
    ): TextEntry {

        return self::make($name, $label, $hiddenLabel)
            ->formatStateUsing($formatUsing)
            ->when($state, fn(TextEntry $entry) => $entry->state($state))
            ->when($color, fn(TextEntry $entry) => $entry->color($color));
    }

    /*
    |--------------------------------------------------------------------------
    | Enum Variant
    |--------------------------------------------------------------------------
    */

    public static function enum(
        string $name,
        ?string $label = null,
        bool $hiddenLabel = false,
        ?Closure $state = null,
    ): TextEntry {

        return self::make(
            name: $name,
            label: $label,
            hiddenLabel: $hiddenLabel
        )
            ->when($state, fn(TextEntry $entry) => $entry->state($state))
            ->when($state, fn(TextEntry $entry) => $entry->formatStateUsing(fn($state) => $state?->label()))
            ->when($state, fn(TextEntry $entry) => $entry->color(fn($state) => $state?->filamentColor()));
    }
}
