<?php

namespace Nexus\Filament\Components\Forms\Fields;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Support\Icons\Heroicon;

class AddressField
{
    /*
    |--------------------------------------------------------------------------
    | Builder
    |--------------------------------------------------------------------------
    */

    public static function make(
        string $name = 'address',
        ?string $label = 'Address',
        bool $required = false,
        int $maxLength = 255,
    ): TextInput {

        return TextInput::make($name)
            ->label($label ? __($label) : null)
            ->required($required)
            ->maxLength($maxLength)
            ->prefixIcon(Heroicon::OutlinedMapPin)
            ->placeholder(__('No address'));
    }

    /*
    |--------------------------------------------------------------------------
    | Country
    |--------------------------------------------------------------------------
    */

    public static function country(
        string $name = 'country_id',
        ?string $label = 'Country',
        array $options = [],
        bool $required = true,
    ): Select {

        return SelectField::make(
            name: $name,
            label: $label,
            options: $options,
            required: $required,
            searchable: true,
            placeholder: __('Select a country'),
        );
    }

    /*
    |--------------------------------------------------------------------------
    | City
    |--------------------------------------------------------------------------
    */

    public static function city(
        string $name = 'city_id',
        ?string $label = 'City',
        array $options = [],
        bool $required = true,
    ): Select {

        return SelectField::make(
            name: $name,
            label: $label,
            options: $options,
            required: $required,
            searchable: true,
            placeholder: __('Select a city'),
        );
    }
}
