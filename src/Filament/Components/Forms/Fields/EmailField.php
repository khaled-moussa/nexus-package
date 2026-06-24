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
        ?string $label = 'Email',
        bool $required = true,
        bool $unique = true,
        ?string $uniqueTable = 'users',
    ): TextInput {

        return TextInput::make($name)
            ->required($required)
            ->email()
            ->maxLength(255)
            ->autocomplete('email')
            ->prefixIcon(Heroicon::OutlinedEnvelope)
            ->when($label, fn(TextInput $field) => $field->label(__($label)))
            ->when($unique && $uniqueTable, fn(TextInput $field) => $field->unique($uniqueTable, ignoreRecord: true));
    }
}
