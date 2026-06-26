<?php

namespace Nexus\Filament\Components\Forms\Fields;

use Nexus\Filament\Components\Forms\Fields\SelectField;
use Nexus\Domain\Tenant\Enums\TenantTypeEnum;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

class TenantField
{
    /*
    |--------------------------------------------------------------------------
    | Base Builder
    |--------------------------------------------------------------------------
    */

    private static function make(
        string $name,
        ?string $label,
        bool $required = true,
        bool $unique = false,
        ?string $uniqueTable = null,
    ): TextInput {

        return NameField::make(
            name: $name,
            label: $label,
            required: $required,
            unique: $unique,
            uniqueTable: $uniqueTable
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
    ): TextInput {

        return self::make(
            name: $name,
            label: $label,
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
    ): TextInput {

        return self::make(
            name: $name,
            label: $label,
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
        bool $unique = true,
        ?string $uniqueTable = 'tenants',
    ): TextInput {

        return self::make(
            name: $name,
            label: $label,
            unique: $unique,
            uniqueTable: $uniqueTable
        );
    }

    public static function commercialRegistrationNumber(
        string $name = 'commercial_registration_number',
        ?string $label = 'Commercial Registration Number',
        bool $unique = true,
        ?string $uniqueTable = 'tenants',
    ): TextInput {

        return self::make(
            name: $name,
            label: $label,
            unique: $unique,
            uniqueTable: $uniqueTable
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Tenant Type
    |--------------------------------------------------------------------------
    */

    public static function type(
        string $name = 'type',
        ?string $label = null,
        array $exclude = [],
    ): Select {

        return SelectField::make(
            name: $name,
            label: $label,
            options: TenantTypeEnum::options($exclude),
        );
    }
}
