<?php

namespace Nexus\Filament\Components\Tables\Columns;

use Filament\Tables\Columns\IconColumn as BaseIconColumn;

class IconColumn
{
    /*
    |--------------------------------------------------------------------------
    | Base Builder
    |--------------------------------------------------------------------------
    */

    public static function make(
        string $name,
        ?string $label = null,
        bool $boolean = false,
    ): BaseIconColumn {

        return BaseIconColumn::make($name)
            ->when($label,   fn(BaseIconColumn $column) => $column->label(__($label)))
            ->when($boolean, fn(BaseIconColumn $column) => $column->boolean());
    }

    /*
    |--------------------------------------------------------------------------
    | Variants
    |--------------------------------------------------------------------------
    */

    /*
    |-------------------------
    | Boolean Variant
    |-------------------------
    */

    public static function boolean(
        string $name,
        ?string $label = null,
    ): BaseIconColumn {

        return self::make(
            name: $name,
            label: $label,
            boolean: true
        );
    }
}
