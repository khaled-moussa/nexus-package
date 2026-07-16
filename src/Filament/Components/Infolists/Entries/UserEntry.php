<?php

namespace Nexus\Filament\Components\Infolists\Entries;

use Filament\Infolists\Components\TextEntry;

class UserEntry
{
    /*
    |--------------------------------------------------------------------------
    | Base Builder
    |--------------------------------------------------------------------------
    */

    private static function make(
        string $name,
        ?string $label       = null,
        bool $bold           = false,
        bool $copyable       = false,
        ?string $placeholder = null,
    ): TextEntry {
        return NameEntry::make(
            name: $name,
            label: $label,
            bold: $bold,
            copyable: $copyable,
            placeholder: $placeholder,
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Name
    |--------------------------------------------------------------------------
    */

    public static function name(
        string $name         = 'full_name',
        ?string $label       = 'Full Name',
        bool $bold           = false,
        ?string $placeholder = 'No full name',
    ): TextEntry {
        return self::make(
            name: $name,
            label: $label,
            bold: $bold,
            placeholder: $placeholder,
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Gender
    |--------------------------------------------------------------------------
    */

    public static function gender(
        string $name         = 'gender',
        ?string $label       = 'Gender',
        bool $badge          = true,
        ?string $placeholder = 'No gender',
    ): TextEntry {
        return NameEntry::enum(
            name: $name,
            label: $label,
            badge: $badge,
            placeholder: $placeholder,
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Email
    |--------------------------------------------------------------------------
    */

    public static function email(
        string $name      = 'email',
        ?string $label    = 'Email',
        bool $copyable    = true,
        string $placeholder = 'No email'
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
        string $name      = 'phone',
        ?string $label    = 'Phone',
        bool $copyable    = true,
        string $placeholder = 'No phone'
    ): TextEntry {
        return self::make(
            name: $name,
            label: $label,
            copyable: $copyable,
            placeholder: $placeholder,
        );
    }
}
