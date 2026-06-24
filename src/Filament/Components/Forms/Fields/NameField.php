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
    ): TextInput {

        return TextInput::make($name)
            ->required($required)
            ->maxLength($maxLength)
            ->autocomplete($name)
            ->when($label, fn(TextInput $field) => $field->label(__($label)));
    }
}
