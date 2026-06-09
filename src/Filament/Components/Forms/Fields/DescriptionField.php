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
        $field = Textarea::make($name)
            ->label($label ? __($label) : null)
            ->required($required)
            ->rows($rows);

        return $fullWidth
            ? $field->columnSpanFull()
            : $field;
    }

    /*
    |--------------------------------------------------------------------------
    | Preset Variants
    |--------------------------------------------------------------------------
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

    public static function medium(string $name, ?string $label = null, bool $required = true): Textarea
    {
        return self::make(
            name: $name,
            label: $label,
            required: $required,
            rows: 3
        );
    }

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
