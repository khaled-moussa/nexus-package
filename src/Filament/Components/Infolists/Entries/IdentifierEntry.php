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
        bool $badge = true,
        bool $copyable = true,
        ?array $color = null,
    ): TextEntry {

        return TextEntry::make($name)
            ->label($label ? __($label) : null)
            ->hiddenLabel($hiddenLabel)
            ->when($badge, fn ($e) => $e->badge())
            ->when($copyable, fn ($e) => $e->copyable())
            ->when($color, fn ($e) => $e->color($color));
    }

    /*
    |--------------------------------------------------------------------------
    | UUID Variant
    |--------------------------------------------------------------------------
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

    /*
    |--------------------------------------------------------------------------
    | ID / Generic Identifier Variant
    |--------------------------------------------------------------------------
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
}