<?php

namespace Nexus\Filament\Components\Forms\Fields;

use libphonenumber\PhoneNumberType;
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;

class PhoneField
{
    /*
    |--------------------------------------------------------------------------
    | Builder
    |--------------------------------------------------------------------------
    */

    public static function make(
        string $name = 'phone',
        ?string $label = 'Phone',
        bool $required = false,
        bool $unique = true,
        ?string $uniqueTable = 'users',
        bool $mobileOnly = true,
        bool $strict = true,
        bool $ipLookup = true,
    ): PhoneInput {

        return PhoneInput::make($name)
            ->label($label ? __($label) : null)
            ->required($required)
            ->when($mobileOnly, fn($field) => $field->validateFor(type: PhoneNumberType::MOBILE))
            ->when($strict, fn($field) => $field->strictMode())
            ->when($ipLookup, fn($field) => $field->enableIpLookup())
            ->when($unique && $uniqueTable, fn($field) => $field->unique($uniqueTable, ignoreRecord: true));
    }
}
