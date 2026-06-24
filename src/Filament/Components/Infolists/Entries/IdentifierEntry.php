<?php

namespace Nexus\Filament\Components\Infolists\Entries;

use Filament\Infolists\Components\TextEntry;
use Filament\Support\Colors\Color;

class IdentifierEntry
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
        ?array $color = null,
        bool $badge = true,
        bool $copyable = true,
    ): TextEntry {

        return TextEntry::make($name)
            ->hiddenLabel($hiddenLabel)
            ->when($label,    fn(TextEntry $entry) => $entry->label(__($label)))
            ->when($color,    fn(TextEntry $entry) => $entry->color($color))
            ->when($badge,    fn(TextEntry $entry) => $entry->badge())
            ->when($copyable, fn(TextEntry $entry) => $entry->copyable());
    }

    /*
    |--------------------------------------------------------------------------
    | Variants
    |--------------------------------------------------------------------------
    */

    /*
    |-------------------------
    | ID Variant
    |-------------------------
    */

    public static function id(
        string $name = 'id',
        ?string $label = 'Ref',
    ): TextEntry {

        return self::make(
            name: $name,
            label: $label,
            color: Color::Gray,
        );
    }

    /*
    |-------------------------
    | UUID Variant
    |-------------------------
    */

    public static function uuid(
        string $name = 'uuid',
        ?string $label = 'Ref',
    ): TextEntry {

        return self::make(
            name: $name,
            label: $label,
            color: Color::Amber,
        );
    }
}
