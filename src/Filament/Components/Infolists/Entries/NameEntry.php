<?php

namespace Nexus\Filament\Components\Infolists\Entries;

use Closure;
use Filament\Infolists\Components\TextEntry;
use Filament\Support\Colors\Color;

class NameEntry
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
        ?string $placeholder = null,
        bool $bold = false,
        Closure|string|null $state = null,
    ): TextEntry {

        return TextEntry::make($name)
            ->label($label ? __($label) : null)
            ->color(Color::Gray)
            ->hiddenLabel($hiddenLabel)
            ->placeholder($placeholder ? __($placeholder) : null)
            ->when($state, fn($entry) => $entry->state($state))
            ->when($bold, fn($entry) => $entry->weight('bold'));
    }

    /*
    |--------------------------------------------------------------------------
    | Variants
    |--------------------------------------------------------------------------
    */

    public static function organization(
        string $name = 'name',
        ?string $label = 'Organization Name',
    ): TextEntry {

        return self::make(
            name: $name,
            label: $label,
        );
    }

    public static function workshop(
        string $name = 'name',
        ?string $label = 'Workshop Name',
    ): TextEntry {

        return self::make(
            name: $name,
            label: $label,
        );
    }
}
