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
    ): BaseIconColumn {

        return BaseIconColumn::make($name)
            ->label($label ? __($label) : null);
    }

    /*
    |--------------------------------------------------------------------------
    | Generic Status (custom icon logic can be extended later)
    |--------------------------------------------------------------------------
    */

    public static function boolean(
        string $name,
        ?string $label = null,
    ): BaseIconColumn {

        return self::make(
            name: $name,
            label: $label
        )
            ->boolean();
    }
}
