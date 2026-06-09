<?php

namespace Nexus\Filament\Components\Tables\Columns;

use Filament\Support\Enums\TextSize;
use Filament\Tables\Columns\TextColumn;

class CountColumn
{
    /*
    |--------------------------------------------------------------------------
    | Base Builder
    |--------------------------------------------------------------------------
    */

    public static function make(
        string $name,
        ?string $label = null,
        ?string $relation = null,
        bool $badge = true,
        TextSize $size = TextSize::Large,
    ): TextColumn {

        return TextColumn::make($name)
            ->label($label ? __($label) : null)
            ->size($size)
            ->when($badge, fn($column) => $column->badge())
            ->when($relation, fn($column) => $column->counts($relation));
    }

    /*
    |--------------------------------------------------------------------------
    | Variants
    |--------------------------------------------------------------------------
    */

    public static function default(
        string $name,
        ?string $label = null,
        ?string $relation = null,
    ): TextColumn {

        return self::make(
            name: $name,
            label: $label,
            relation: $relation,
        );
    }

    public static function large(
        string $name,
        ?string $label = null,
        ?string $relation = null,
    ): TextColumn {

        return self::make(
            name: $name,
            label: $label,
            relation: $relation,
            size: TextSize::Large,
        );
    }
}
