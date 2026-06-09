<?php

namespace Nexus\Filament\Components\Forms\Fields;

use Filament\Forms\Components\Toggle;

class ToggleField
{
    /*
    |--------------------------------------------------------------------------
    | Builder
    |--------------------------------------------------------------------------
    */

    public static function make(
        string $name,
        ?string $label = null,
        bool $default = true,
        bool $hiddenLabel = false,
        bool $inline = false,
        ?string $helperText = null,
    ): Toggle {

        return Toggle::make($name)
            ->label($label ? __($label) : null)
            ->default($default)
            ->inline($inline)
            ->when($hiddenLabel, fn($field) => $field->hiddenLabel())
            ->when($helperText, fn($field) => $field->belowLabel(__($helperText)));
    }

    /*
    |--------------------------------------------------------------------------
    | Variants (Optional Clean API)
    |--------------------------------------------------------------------------
    */

    public static function active(
        string $name = 'is_active',
        ?string $label = 'Active'
    ): Toggle {
        return self::make(
            name: $name,
            label: $label,
            default: true,
        );
    }
}
