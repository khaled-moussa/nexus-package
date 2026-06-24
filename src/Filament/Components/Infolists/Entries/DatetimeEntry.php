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
        bool $hiddenLabel = false,
        ?string $placeholder = null,
    ): TextEntry {

        return TextEntry::make($name)
            ->hiddenLabel($hiddenLabel)
            ->when($label,       fn(TextEntry $field) => $field->label(__($label)))
            ->when($badge,       fn(TextEntry $entry) => $entry->badge())
            ->when($placeholder, fn(TextEntry $entry) => $entry->placeholder(__($placeholder)));
    }

    /*
    |--------------------------------------------------------------------------
    | Variants
    |--------------------------------------------------------------------------
    */

    /*
    |-------------------------
    | Created At Variant
    |-------------------------
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

    /*
    |-------------------------
    | Updated At Variant
    |-------------------------
    */

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

    /*
    |-------------------------
    | Completed At Variant
    |-------------------------
    */

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

    /*
    |-------------------------
    | Received At Variant
    |-------------------------
    */

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
