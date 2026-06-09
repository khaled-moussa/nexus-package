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
    ): TextEntry {

        return TextEntry::make($name)
            ->label($label ? __($label) : null)
            ->hiddenLabel($hiddenLabel)
            ->weight(FontWeight::Bold)
            ->placeholder('—');
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
    ): TextEntry {

        return TextEntry::make($name)
            ->label($label ? __($label) : null)
            ->hiddenLabel($hiddenLabel)
            ->badge()
            ->color(fn ($state) => $state?->filamentColor())
            ->formatStateUsing(fn ($state) => $state?->label())
            ->placeholder('—');
    }
}