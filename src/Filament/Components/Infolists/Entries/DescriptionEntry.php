<?php

namespace Nexus\Filament\Components\Infolists\Entries;

use Filament\Infolists\Components\TextEntry;
use Filament\Support\Colors\Color;

class DescriptionEntry
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
        bool $fullWidth = true,
        ?string $placeholder = null,
    ): TextEntry {

        return TextEntry::make($name)
            ->label($label ? __($label) : null)
            ->hiddenLabel($hiddenLabel)
            ->color(Color::Gray)
            ->placeholder($placeholder ?? __('No description'))
            ->when($fullWidth, fn ($entry) => $entry->columnSpanFull());
    }

    /*
    |--------------------------------------------------------------------------
    | Variants
    |--------------------------------------------------------------------------
    */

    public static function full(
        string $name,
        ?string $label = null,
    ): TextEntry {

        return self::make(
            name: $name,
            label: $label,
            fullWidth: true,
        );
    }

    public static function compact(
        string $name,
        ?string $label = null,
    ): TextEntry {

        return self::make(
            name: $name,
            label: $label,
            fullWidth: false,
        );
    }
}