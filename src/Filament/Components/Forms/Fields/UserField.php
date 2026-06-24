<?php

namespace Nexus\Filament\Components\Forms\Fields;

use Nexus\Filament\Components\Forms\Fields\SelectField;
use Nexus\Filament\Components\Forms\Fields\NameField;
use Nexus\Domain\User\Enums\GenderEnum;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

class UserField
{
    /*
    |--------------------------------------------------------------------------
    | First Name
    |--------------------------------------------------------------------------
    */

    public static function firstName(
        string $name = 'first_name',
        ?string $label = 'First Name',
        bool $required = true,
    ): TextInput {

        return NameField::make(
            name: $name,
            label: $label,
            required: $required,
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Last Name
    |--------------------------------------------------------------------------
    */

    public static function lastName(
        string $name = 'last_name',
        ?string $label = 'Last Name',
        bool $required = true,
    ): TextInput {

        return NameField::make(
            name: $name,
            label: $label,
            required: $required,
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Gender
    |--------------------------------------------------------------------------
    */

    public static function gender(
        string $name = 'gender',
        ?string $label = 'Gender',
        bool $required = true,
    ): Select {
        
        return SelectField::make(
            name: $name,
            label: $label,
            required: $required,
            options: GenderEnum::options(),
        );
    }
}
