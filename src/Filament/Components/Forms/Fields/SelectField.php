<?php

namespace Nexus\Filament\Components\Forms\Fields;

use Filament\Forms\Components\Select;
use Filament\Support\Icons\Heroicon;

class SelectField
{
    /*
    |--------------------------------------------------------------------------
    | Base Builder
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
        string|Heroicon|null $prefixIcon = null,
        ?bool $fullWidth = null,
    ): Select {

        return Select::make($name)
            ->required($required)
            ->options($options)
            ->searchable($searchable)
            ->native($native)
            ->when($label,       fn(Select $field) => $field->label(__($label)))
            ->when($placeholder, fn(Select $field) => $field->placeholder(__($placeholder)))
            ->when($prefixIcon,  fn(Select $field) => $field->prefixIcon($prefixIcon))
            ->when($fullWidth,   fn(Select $field) => $field->columnSpanFull());
    }
}
