<?php

namespace Nexus\Filament\Components\Tables\Columns;

use Filament\Tables\Columns\TextColumn;

class StatusColumn
{
    /*
    |--------------------------------------------------------------------------
    | Enum State (Badge)
    |--------------------------------------------------------------------------
    */

    public static function make(
        string $name,
        ?string $label = null,
        bool $toggleable = true,
        bool $defaultHidden = false,
    ): TextColumn {

        return TextColumn::make($name)
            ->label($label ? __($label) : null)
            ->badge()
            ->formatStateUsing(fn($state) => $state?->label())
            ->color(fn($state) => $state?->filamentColor())
            ->toggleable($toggleable, isToggledHiddenByDefault: $defaultHidden);
    }
}
