<?php

namespace Nexus\Filament\Components\Infolists\Entries;

use Filament\Infolists\Components\TextEntry;
use Filament\Support\Icons\Heroicon;

class EmailEntry
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
        bool $copyable = true,
        bool $icon = true,
    ): TextEntry {

        return TextEntry::make($name)
            ->label($label ? __($label) : null)
            ->hiddenLabel($hiddenLabel)
            ->when($icon, fn ($entry) => $entry->icon(Heroicon::OutlinedEnvelope))
            ->when($copyable, fn ($entry) => $entry->copyable());
    }

    /*
    |--------------------------------------------------------------------------
    | Variants
    |--------------------------------------------------------------------------
    */

    public static function default(
        string $name = 'email',
        ?string $label = null,
    ): TextEntry {

        return self::make(
            name: $name,
            label: $label,
        );
    }

    public static function readonly(
        string $name,
        ?string $label = null,
    ): TextEntry {

        return self::make(
            name: $name,
            label: $label,
            copyable: false,
        );
    }
}