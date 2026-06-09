<?php

namespace Nexus\Filament\Components\Forms\Fields;

use Filament\Forms\Components\Select;

class SelectField
{
    /*
    |--------------------------------------------------------------------------
    | Builder
    |--------------------------------------------------------------------------
    */

    public static function make(
        string $name,
        ?string $label = null,
        bool $required = true,
        array $options = [],
        bool $searchable = false,
        bool $native = false,
        ?string $placeholder = null,
    ): Select {
        return Select::make($name)
            ->label($label ? __($label) : null)
            ->required($required)
            ->options($options)
            ->searchable($searchable)
            ->native($native)
            ->when($placeholder, fn (Select $field) => $field->placeholder(__($placeholder)));
    }
}
