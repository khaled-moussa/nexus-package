<?php

namespace Nexus\Filament\Components\Infolists\Entries;

use Filament\Infolists\Components\TextEntry;
use Filament\Support\Enums\TextSize;

class CountEntry
{
    /*
    |--------------------------------------------------------------------------
    | Base Builder
    |--------------------------------------------------------------------------
    */
    public static function make(
        string $name,
        ?string $label = null,
        ?string $relation = null,
        bool $hiddenLabel = false,
        TextSize $size = TextSize::Medium,
        bool $badge = false,
    ): TextEntry {

        return TextEntry::make($name)
            ->hiddenLabel($hiddenLabel)
            ->size($size)
            ->when($label,    fn(TextEntry $field) => $field->label(__($label)))
            ->when($badge,    fn(TextEntry $entry) => $entry->badge())
            ->when($relation, fn(TextEntry $entry) => $entry->counts($relation));
    }

    /*
    |--------------------------------------------------------------------------
    | Variants
    |--------------------------------------------------------------------------
    */

    /*
    |-------------------------
    | Badge Variant
    |-------------------------
    */

    public static function badge(
        string $name,
        ?string $label = null,
        ?string $relation = null,
        bool $hiddenLabel = false,
    ): TextEntry {

        return self::make(
            name: $name,
            label: $label,
            relation: $relation,
            hiddenLabel: $hiddenLabel,
            badge: true,
        );
    }

    /*
    |-------------------------
    | Small Text Variant
    |-------------------------
    */

    public static function sm(
        string $name,
        ?string $label = null,
        ?string $relation = null,
        bool $hiddenLabel = false,
        bool $badge = false,
    ): TextEntry {

        return self::make(
            name: $name,
            label: $label,
            relation: $relation,
            hiddenLabel: $hiddenLabel,
            size: TextSize::Small,
            badge: $badge,
        );
    }

    /*
    |-------------------------
    | Medium Text Variant
    |-------------------------
    */

    public static function md(
        string $name,
        ?string $label = null,
        ?string $relation = null,
        bool $hiddenLabel = false,
        bool $badge = false,
    ): TextEntry {

        return self::make(
            name: $name,
            label: $label,
            relation: $relation,
            hiddenLabel: $hiddenLabel,
            size: TextSize::Medium,
            badge: $badge,
        );
    }

    /*
    |-------------------------
    | Large Text Variant
    |-------------------------
    */

    public static function lg(
        string $name,
        ?string $label = null,
        ?string $relation = null,
        bool $hiddenLabel = false,
        bool $badge = false,
    ): TextEntry {

        return self::make(
            name: $name,
            label: $label,
            relation: $relation,
            hiddenLabel: $hiddenLabel,
            size: TextSize::Large,
            badge: $badge,
        );
    }
}
