<?php

namespace Nexus\Filament\Components\Forms\Fields;

use Filament\Forms\Components\TextInput;

class NameField
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
        int $maxLength = 255,
        bool $unique = false,
        ?string $uniqueTable = null,
        bool $live = false,
        bool $disabled = false,
        ?string $placeholder = null,
    ): TextInput {

        return TextInput::make($name)
            ->required($required)
            ->maxLength($maxLength)
            ->autocomplete($name)
            ->when($label,       fn(TextInput $field) => $field->label(__($label)))
            ->when($live,        fn(TextInput $field) => $field->live($live))
            ->when($disabled,    fn(TextInput $field) => $field->disabled($disabled))
            ->when($placeholder, fn(TextInput $field) => $field->placeholder(__($placeholder)))
            ->when($unique && $uniqueTable, fn(TextInput $field) => $field->unique($uniqueTable, ignoreRecord: true));
    }
}
