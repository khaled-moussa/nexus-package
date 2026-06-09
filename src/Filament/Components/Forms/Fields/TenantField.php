<?php

namespace Nexus\Filament\Components\Forms\Fields;

use Nexus\Domain\Tenant\Enums\TenantTypeEnum;
use Nexus\Filament\Components\Forms\Fields\SelectField;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

class TenantField
{
    /*
    |--------------------------------------------------------------------------
    | Organization Name
    |--------------------------------------------------------------------------
    */

    public static function organization(
        string $name = 'name',
        ?string $label = 'Organization Name',
    ): TextInput {

        return NameField::make(
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

        return NameField::make(
            name: $name,
            label: $label,
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
        bool $required = true,
        array $exclude = [],
    ): Select {
        return SelectField::make(
            name: $name,
            label: $label,
            required: $required,
            options: TenantTypeEnum::options($exclude),
        );
    }
}
