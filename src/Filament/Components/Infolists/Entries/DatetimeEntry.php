<?php

namespace Nexus\Filament\Components\Infolists\Entries;

use Filament\Infolists\Components\TextEntry;

class DatetimeEntry
{
    /*
    |--------------------------------------------------------------------------
    | Base Builder
    |--------------------------------------------------------------------------
    */

    public static function make(
        string $name,
        ?string $label = null,
        bool $badge = false,
        ?string $placeholder = null,
    ): TextEntry {

        return TextEntry::make($name)
            ->label($label ? __($label) : null)
            ->when($badge, fn($entry) => $entry->badge())
            ->placeholder($placeholder ?? __('No date'));
    }

    /*
    |--------------------------------------------------------------------------
    | Variants - Semantic
    |--------------------------------------------------------------------------
    */

    public static function createdAt(
        string $name = 'created_at_formatted',
        ?string $label = 'Created at',
    ): TextEntry {

        return self::make(
            name: $name,
            label: $label,
            badge: true,
        );
    }

    public static function updatedAt(
        string $name = 'updated_at',
        ?string $label = 'Updated at',
    ): TextEntry {

        return self::make(
            name: $name,
            label: $label,
            badge: true,
        );
    }

    public static function completedAt(
        string $name = 'completed_at_formatted',
        ?string $label = 'Completed at',
    ): TextEntry {

        return self::make(
            name: $name,
            label: $label,
            badge: true,
        );
    }

    public static function receivedAt(
        string $name = 'received_at_formatted',
        ?string $label = 'Received at',
    ): TextEntry {

        return self::make(
            name: $name,
            label: $label,
            badge: true,
        );
    }
}
