<?php

namespace Nexus\Filament\Components\Forms\Fields;

use Filament\Forms\Components\TextInput;
use Filament\Support\Icons\Heroicon;

class PasswordField
{
    /*
    |--------------------------------------------------------------------------
    | Builder
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
            ->label($label ? __($label) : null)
            ->required($required)
            ->password()
            ->maxLength(255)
            ->autocomplete('new-password')
            ->confirmed()
            ->prefixIcon(Heroicon::OutlinedLockClosed)
            ->when($confirmed, fn ($field) => $field->confirmed())
            ->when($helperText, fn ($field) => $field->helperText($helperText));
    }
}