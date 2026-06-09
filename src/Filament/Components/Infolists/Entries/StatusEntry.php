<?php

namespace Nexus\Filament\Components\Infolists\Entries;

use Closure;
use Filament\Infolists\Components\TextEntry;

class StatusEntry
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
        bool $badge = true,
        ?string $placeholder = null,
    ): TextEntry {

        return TextEntry::make($name)
            ->label($label ? __($label) : null)
            ->hiddenLabel($hiddenLabel)
            ->when(
                $placeholder,
                fn(TextEntry $entry) => $entry->placeholder($placeholder)
            )
            ->when(
                $badge,
                fn(TextEntry $entry) => $entry->badge()
            );
    }

    /*
    |--------------------------------------------------------------------------
    | Boolean Status
    |--------------------------------------------------------------------------
    */

    public static function boolean(
        string $name,
        ?string $label = null,
        bool $hiddenLabel = false,
        ?Closure $state = null,
    ): TextEntry {

        return self::make($name, $label, $hiddenLabel)
            ->when(! is_null($state), fn(TextEntry $entry) => $entry->state($state))
            ->formatStateUsing(fn($state) => (bool) $state ? __('Active') : __('Inactive'))
            ->color(fn($state) => (bool) $state ? 'success'  : 'danger');
    }

    /*
    |--------------------------------------------------------------------------
    | Custom Status
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
            ->when(! is_null($state), fn(TextEntry $entry) => $entry->state($state))
            ->when($color, fn(TextEntry $entry) => $entry->color($color))
            ->formatStateUsing($formatUsing);
    }

    /*
    |--------------------------------------------------------------------------
    | Enum Status
    |--------------------------------------------------------------------------
    */

    public static function enum(
        string $name,
        ?string $label = null,
        bool $hiddenLabel = false,
        ?Closure $state = null,
    ): TextEntry {

        return self::make($name, $label, $hiddenLabel)
            ->when(! is_null($state), fn(TextEntry $entry) => $entry->state($state))
            ->formatStateUsing(fn($state) => $state?->label())
            ->color(fn($state) => $state?->filamentColor());
    }
}
