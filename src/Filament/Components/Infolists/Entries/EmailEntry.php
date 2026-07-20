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
        ?string $label = 'Email',
        bool $hiddenLabel = false,
        bool $icon = true,
        bool $copyable = true,
    ): TextEntry {

        return TextEntry::make($name)
            ->hiddenLabel($hiddenLabel)
            ->when($label,    fn(TextEntry $entry) => $entry->label(__($label)))
            ->when($icon,     fn(TextEntry $entry) => $entry->icon(Heroicon::OutlinedEnvelope))
            ->when($copyable, fn(TextEntry $entry) => $entry->copyable());
    }



    /*
    |-------------------------
    | Readonly Variant
    |-------------------------
    */

    public static function readonly(
        string $name,
        ?string $label = 'Email',
    ): TextEntry {

        return self::make(
            name: $name,
            label: $label,
            copyable: false,
        );
    }
}
