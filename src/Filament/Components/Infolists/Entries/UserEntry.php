<?php

namespace Nexus\Filament\Components\Infolists\Entries;

use Filament\Infolists\Components\TextEntry;
use Filament\Support\Enums\FontWeight;

class UserEntry
{
    /*
    |--------------------------------------------------------------------------
    | Full name
    |--------------------------------------------------------------------------
    */

    public static function name(
        string $name = 'full_name',
        ?string $label = 'Full name',
        bool $hiddenLabel = false,
        bool $bold = true,
        ?string $placeholder = null,
    ): TextEntry {

        return TextEntry::make($name)
            ->hiddenLabel($hiddenLabel)
            ->when($label,       fn(TextEntry $entry) => $entry->label(__($label)))
            ->when($bold,        fn(TextEntry $entry) => $entry->weight(FontWeight::Bold))
            ->when($placeholder, fn(TextEntry $entry) => $entry->placeholder(__($placeholder)));
    }

    /*
    |--------------------------------------------------------------------------
    | Gender
    |--------------------------------------------------------------------------
    */

    public static function gender(
        string $name = 'gender',
        ?string $label = 'Gender',
        bool $hiddenLabel = false,
        ?string $placeholder = null,
    ): TextEntry {

        return TextEntry::make($name)
            ->hiddenLabel($hiddenLabel)
            ->badge()
            ->color(fn($state) => $state?->filamentColor())
            ->formatStateUsing(fn($state) => $state?->label())
            ->when($label,       fn(TextEntry $entry) => $entry->label(__($label)))
            ->when($placeholder, fn(TextEntry $entry) => $entry->placeholder(__($placeholder)));
    }
}
