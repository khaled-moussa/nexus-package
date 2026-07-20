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
            ->hiddenLabel($hiddenLabel)
            ->color(Color::Gray)
            ->when($label,       fn(TextEntry $entry) => $entry->label(__($label)))
            ->when($fullWidth,   fn(TextEntry $entry) => $entry->columnSpanFull())
            ->when($placeholder, fn(TextEntry $entry) => $entry->placeholder(__($placeholder)));
    }



    /*
    |-------------------------
    | Compact Width Variant
    |-------------------------
    */

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
