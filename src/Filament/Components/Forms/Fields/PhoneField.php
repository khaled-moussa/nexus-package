<?php

namespace Nexus\Filament\Components\Forms\Fields;

use libphonenumber\PhoneNumberType;
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;

class PhoneField
{
    /*
    |--------------------------------------------------------------------------
    | Base Builder
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
            ->required($required)
            ->when($label,      fn(PhoneInput $field) => $field->label(__($label)))
            ->when($mobileOnly, fn(PhoneInput $field) => $field->validateFor(type: PhoneNumberType::MOBILE))
            ->when($strict,     fn(PhoneInput $field) => $field->strictMode())
            ->when($ipLookup,   fn(PhoneInput $field) => $field->enableIpLookup())
            ->when($unique && $uniqueTable, fn(PhoneInput $field) => $field->unique($uniqueTable, ignoreRecord: true));
    }
}
