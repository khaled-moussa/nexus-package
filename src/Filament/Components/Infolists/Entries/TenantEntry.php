<?php

namespace Nexus\Filament\Components\Infolists\Entries;

use Filament\Infolists\Components\TextEntry;

class TenantEntry
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
        bool $badge          = false,
        bool $copyable       = false,
        ?string $placeholder = null,
    ): TextEntry {

        return NameEntry::make(
            name: $name,
            label: $label,
            bold: $bold,
            badge: $badge,
            copyable: $copyable,
            placeholder: $placeholder,
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Organization Name
    |--------------------------------------------------------------------------
    */

    public static function organization(
        string $name = 'name',
        ?string $label = 'Organization Name',
        bool $bold = true,
    ): TextEntry {

        return self::make(
            name: $name,
            label: $label,
            bold: $bold,
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Workshop Name
    |--------------------------------------------------------------------------
    */

    public static function workshop(
        string $name = 'name',
        ?string $label = 'Workshop Name',
        bool $bold = true,
    ): TextEntry {

        return self::make(
            name: $name,
            label: $label,
            bold: $bold,
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Legal Details
    |--------------------------------------------------------------------------
    */

    public static function taxNumber(
        string $name = 'tax_number',
        ?string $label = 'Tax Number',
        ?string $placeholder = 'No tax'
    ): TextEntry {

        return self::make(
            name: $name,
            label: $label,
            copyable: true,
            placeholder: $placeholder,
        );
    }

    public static function commercialRegistrationNumber(
        string $name = 'commercial_registration_number',
        ?string $label = 'Commercial Registration Number',
        ?string $placeholder = 'No commercial registration'
    ): TextEntry {

        return self::make(
            name: $name,
            label: $label,
            copyable: true,
            placeholder: $placeholder,
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Contact Information
    |--------------------------------------------------------------------------
    */

    public static function phone(
        string $name = 'phone',
        ?string $label = 'Phone',
        ?string $placeholder = 'No phone'
    ): TextEntry {

        return self::make(
            name: $name,
            label: $label,
            copyable: true,
            placeholder: $placeholder,
        );
    }

    public static function address(
        string $name = 'address',
        ?string $label = 'Address',
        ?string $placeholder = 'No address'
    ): TextEntry {

        return self::make(
            name: $name,
            label: $label,
            placeholder: $placeholder,
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Tenant Type
    |--------------------------------------------------------------------------
    */

    public static function type(
        string $name = 'type',
        ?string $label = 'Type',
        ?bool $badge = true,
    ): TextEntry {

        return self::make(
            name: $name,
            label: $label,
            badge: $badge,
        );
    }
}
