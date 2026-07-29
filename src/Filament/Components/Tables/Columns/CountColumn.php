<?php

namespace Nexus\Filament\Components\Tables\Columns;

use Closure;
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
        ?callable $formatUsing = null,
    ): TextColumn {

        $column = TextColumn::make($name)
            ->size($size)
            ->when($label,    fn(TextColumn $column) => $column->label(__($label)))
            ->when($badge,    fn(TextColumn $column) => $column->badge())
            ->when($relation, fn(TextColumn $column) => $column->counts($relation));

        if ($formatUsing) {
            $column->formatStateUsing($formatUsing);
        }

        return $column;
    }
}
