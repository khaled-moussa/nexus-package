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
            ->when($label,    fn(BaseToggleColumn $column) => $column->label(__($label)))
            ->when($sortable, fn(BaseToggleColumn $column) => $column->sortable());
    }



    /*
    |-------------------------
    | Active Variant
    |-------------------------
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
