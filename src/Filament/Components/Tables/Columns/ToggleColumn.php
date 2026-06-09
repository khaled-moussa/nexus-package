<?php

namespace Nexus\Filament\Components\Tables\Columns;

use Filament\Tables\Columns\ToggleColumn as BaseToggleColumn;

class ToggleColumn
{
    /*
    |--------------------------------------------------------------------------
    | Base Builder
    |--------------------------------------------------------------------------
    */

    public static function make(
        string $name,
        ?string $label = null,
        bool $sortable = true,
    ): BaseToggleColumn {

        return BaseToggleColumn::make($name)
            ->label($label ? __($label) : null)
            ->when($sortable, fn ($column) => $column->sortable());
    }

    /*
    |--------------------------------------------------------------------------
    | Variants
    |--------------------------------------------------------------------------
    */

    public static function active(
        string $name = 'is_active',
        ?string $label = 'Active',
    ): BaseToggleColumn {

        return self::make(
            name: $name,
            label: $label,
        );
    }
}