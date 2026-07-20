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
            ->size($size)
            ->when($label,    fn(TextColumn $column) => $column->label(__($label)))
            ->when($badge,    fn(TextColumn $column) => $column->badge())
            ->when($relation, fn(TextColumn $column) => $column->counts($relation));
    }



    /*
    |-------------------------
    | Default Variant
    |-------------------------
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

    /*
    |-------------------------
    | Large Variant
    |-------------------------
    */

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
