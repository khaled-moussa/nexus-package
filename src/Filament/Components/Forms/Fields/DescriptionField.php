<?php

namespace Nexus\Filament\Components\Forms\Fields;

use Filament\Forms\Components\Textarea;

class DescriptionField
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
        int $rows = 3,
        bool $fullWidth = true,
    ): Textarea {

        return Textarea::make($name)
            ->required($required)
            ->rows($rows)
            ->when($label, fn(Textarea $field) => $field->label(__($label)))
            ->when($fullWidth, fn(Textarea $field) => $field->columnSpanFull());
    }

    /*
    |--------------------------------------------------------------------------
    | Variants
    |--------------------------------------------------------------------------
    */

    /*
    |-------------------------
    | Short Variant Rows (1) 
    |-------------------------
    */

    public static function short(string $name, ?string $label = null, bool $required = true,): Textarea
    {
        return self::make(
            name: $name,
            label: $label,
            required: $required,
            rows: 1,
        );
    }

    /*
    |-------------------------
    | Medium Variant Rows (3) 
    |-------------------------
    */

    public static function medium(string $name, ?string $label = null, bool $required = true): Textarea
    {
        return self::make(
            name: $name,
            label: $label,
            required: $required,
            rows: 3
        );
    }

    /*
    |-------------------------
    | Long Variant Rows (4) 
    |-------------------------
    */

    public static function long(string $name, ?string $label = null, bool $required = true): Textarea
    {
        return self::make(
            name: $name,
            label: $label,
            required: $required,
            rows: 4
        );
    }
}
