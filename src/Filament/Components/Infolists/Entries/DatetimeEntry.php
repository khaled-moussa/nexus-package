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
        ?string $placeholder = 'No date',
    ): TextEntry {

        return self::make(
            name: $name,
            label: $label,
            badge: true,
            placeholder: $placeholder
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
        ?string $placeholder = 'No date',
    ): TextEntry {

        return self::make(
            name: $name,
            label: $label,
            badge: true,
            placeholder: $placeholder
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
        ?string $placeholder = 'No date',
    ): TextEntry {

        return self::make(
            name: $name,
            label: $label,
            badge: true,
            placeholder: $placeholder
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
        ?string $placeholder = 'No date',
    ): TextEntry {

        return self::make(
            name: $name,
            label: $label,
            badge: true,
            placeholder: $placeholder
        );
    }
}
