<?php

namespace Nexus\Filament\Components\Forms\Fields;

use Filament\Forms\Components\TextInput;

class NumericField
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
        int|float|string|null $default = null,
        int|float|null $minValue = null,
        int|float|null $maxValue = null,
        ?string $suffix = null,
    ): TextInput {

        return TextInput::make($name)
            ->numeric()
            ->required($required)
            ->when($label,    fn(TextInput $field) => $field->label(__($label)))
            ->when($default,  fn(TextInput $field) => $field->default($default))
            ->when($minValue, fn(TextInput $field) => $field->minValue($minValue))
            ->when($maxValue, fn(TextInput $field) => $field->maxValue($maxValue))
            ->when($suffix,   fn(TextInput $field) => $field->suffix($suffix));
    }



    /*
    |-------------------------
    | Money Variant
    |-------------------------
    */

    public static function money(
        string $name,
        ?string $label = null,
        bool $required = true,
        string $currency = 'SAR',
        int|float|string|null $default = null,
        int|float|null $minValue = null,
        int|float|null $maxValue = null,
    ): TextInput {

        return self::make(
            name: $name,
            label: $label,
            required: $required,
            default: $default,
            minValue: $minValue,
            maxValue: $maxValue,
            suffix: $currency,
        );
    }


    /*
    |-------------------------
    | Percentage Variant
    |-------------------------
    */

    public static function percentage(
        string $name,
        ?string $label = null,
        bool $required = true,
        int|float $max = 100,
        int|float|string|null $default = null,
    ): TextInput {

        return self::make(
            name: $name,
            label: $label,
            required: $required,
            default: $default,
            minValue: 0,
            maxValue: $max,
            suffix: '%',
        );
    }

    /*
    |-------------------------
    | Decimal Variant
    |-------------------------
    */

    public static function decimal(
        string $name,
        ?string $label = null,
        bool $required = true,
        int|float|string|null $default = null,
        int|float|null $minValue = null,
        int|float|null $maxValue = null,
    ): TextInput {

        return self::make(
            name: $name,
            label: $label,
            required: $required,
            default: $default,
            minValue: $minValue,
            maxValue: $maxValue,
        );
    }
}
