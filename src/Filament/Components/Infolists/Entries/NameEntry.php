<?php

namespace Nexus\Filament\Components\Infolists\Entries;

use Filament\Infolists\Components\TextEntry;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\FontWeight;
use Closure;

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
        string|Closure|null $state = null,
        bool $isSub = true,
        bool $bold = false,
        bool $badge = false,
        string|Color|array|null $color = null,
        ?string $placeholder = null,
    ): TextEntry {

        return TextEntry::make($name)
            ->hiddenLabel($hiddenLabel)
            ->color(Color::Gray)
            ->when($label,       fn(TextEntry $entry) => $entry->label(__($label)))
            ->when($state,       fn(TextEntry $entry) => $entry->state($state))
            ->when($bold,        fn(TextEntry $entry) => $entry->weight(FontWeight::Bold))
            ->when($badge,       fn(TextEntry $entry) => $entry->badge())
            ->when($color,       fn(TextEntry $entry) => $entry->color($color))
            ->when($isSub,       fn(TextEntry $entry) => $entry->color(Color::Gray))
            ->when($placeholder, fn(TextEntry $entry) => $entry->placeholder(__($placeholder)));
    }

    /*
    |--------------------------------------------------------------------------
    | Variants
    |--------------------------------------------------------------------------
    */

    /*
    |-------------------------
    | Organization Variant
    |-------------------------
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

    /*
    |-------------------------
    | Workshop Variant
    |-------------------------
    */

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
