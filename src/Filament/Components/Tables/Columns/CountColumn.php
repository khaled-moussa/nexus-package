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
        ?callable $formatUsing = null,
        bool $toggleable = false,
        bool $defaultHidden = false,
    ): TextColumn {

        $column = TextColumn::make($name)
            ->size($size)
            ->toggleable($toggleable, isToggledHiddenByDefault: $defaultHidden)
            ->when($label,    fn(TextColumn $column) => $column->label(__($label)))
            ->when($badge,    fn(TextColumn $column) => $column->badge())
            ->when($relation, fn(TextColumn $column) => $column->counts($relation));

        if ($formatUsing) {
            $column->formatStateUsing($formatUsing);
        }

        return $column;
    }
}
