<?php

namespace Nexus\Filament\Components\Infolists\Entries;

use Filament\Infolists\Components\TextEntry;

class ContactEntry
{
    /*
    |--------------------------------------------------------------------------
    | Base Builder
    |--------------------------------------------------------------------------
    */

    private static function make(
        string $name,
        ?string $label       = null,
        bool $copyable       = true,
        ?string $placeholder = null,
    ): TextEntry {
        return NameEntry::make(
            name: $name,
            label: $label,
            copyable: $copyable,
            placeholder: $placeholder,
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Email
    |--------------------------------------------------------------------------
    */

    public static function email(
        string $name        = 'email',
        ?string $label      = 'Email',
        bool $copyable      = true,
        string $placeholder = 'No email',
    ): TextEntry {
        return self::make(
            name: $name,
            label: $label,
            copyable: $copyable,
            placeholder: $placeholder,
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Phone
    |--------------------------------------------------------------------------
    */

    public static function phone(
        string $name        = 'phone',
        ?string $label      = 'Phone',
        bool $copyable      = true,
        string $placeholder = 'No phone',
    ): TextEntry {
        $entry =  self::make(
            name: $name,
            label: $label,
            copyable: $copyable,
            placeholder: $placeholder,
        );

        if ($entry) {
            $entry->extraAttributes(['class' => 'ltr']);
        }

        return $entry;
    }
}
