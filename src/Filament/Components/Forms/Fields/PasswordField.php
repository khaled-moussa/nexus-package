<?php

namespace Nexus\Filament\Components\Forms\Fields;

use Filament\Forms\Components\TextInput;
use Filament\Support\Icons\Heroicon;

class PasswordField
{
    /*
    |--------------------------------------------------------------------------
    | Base Builder
    |--------------------------------------------------------------------------
    */

    public static function make(
        string $name = 'password',
        ?string $label = 'Password',
        bool $required = false,
        bool $confirmed = false,
        ?string $helperText = null,
    ): TextInput {

        return TextInput::make($name)
            ->required($required)
            ->password()
            ->confirmed()
            ->prefixIcon(Heroicon::OutlinedLockClosed)
            ->when($label,      fn(TextInput $field) => $field->label(__($label)))
            ->when($confirmed,  fn(TextInput $field) => $field->confirmed())
            ->when($helperText, fn(TextInput $field) => $field->helperText($helperText));
    }
}
