<?php

namespace Nexus\Filament\Components\Tables\Columns;

use Filament\Tables\Columns\TextColumn;

class StatusColumn
{
    /*
    |--------------------------------------------------------------------------
    | Base Builder
    |--------------------------------------------------------------------------
    */

    public static function make(
        string $name,
        ?string $label = null,
        bool $toggleable = true,
        bool $defaultHidden = false,
    ): TextColumn {

        return TextColumn::make($name)
            ->badge()
            ->toggleable($toggleable, isToggledHiddenByDefault: $defaultHidden)
            ->color(fn($state) => $state?->colorFilament())
            ->formatStateUsing(fn($state) => $state?->label())
            ->when($label, fn(TextColumn $column) => $column->label(__($label)))
        ;
    }
}
