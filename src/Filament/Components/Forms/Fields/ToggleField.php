<?php

namespace Nexus\Filament\Components\Forms\Fields;

use Filament\Forms\Components\Toggle;

class ToggleField
{
    /*
    |--------------------------------------------------------------------------
    | Base Builder
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
            ->default($default)
            ->inline($inline)
            ->when($label,       fn(Toggle $field) => $field->label(__($label)))
            ->when($hiddenLabel, fn(Toggle $field) => $field->hiddenLabel())
            ->when($helperText,  fn(Toggle $field) => $field->belowLabel(__($helperText)));
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
