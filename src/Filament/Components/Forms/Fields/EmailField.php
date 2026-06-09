<?php

namespace Nexus\Filament\Components\Forms\Fields;

use Filament\Forms\Components\TextInput;
use Filament\Support\Icons\Heroicon;

class EmailField
{
    /*
    |--------------------------------------------------------------------------
    | Base Builder
    |--------------------------------------------------------------------------
    */

    public static function make(
        string $name = 'email',
        ?string $label = null,
        bool $required = true,
        bool $unique = true,
        ?string $uniqueTable = 'users',
    ): TextInput {

        return TextInput::make($name)
            ->label($label ? __($label) : __('Email'))
            ->required($required)
            ->email()
            ->maxLength(255)
            ->autocomplete('email')
            ->prefixIcon(Heroicon::OutlinedEnvelope)
            ->when($unique && $uniqueTable, fn($field) => $field->unique($uniqueTable, ignoreRecord: true));
    }
}
