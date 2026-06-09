<?php

namespace Nexus\Filament\Components\Tables\Columns;

use Filament\Tables\Columns\TextColumn;

class DatetimeColumn
{
    /*
    |--------------------------------------------------------------------------
    | Base Builder
    |--------------------------------------------------------------------------
    */

    public static function make(
        string $name,
        ?string $label = null,
        bool $badge = false,
        bool $toggleable = true,
        bool $defaultHidden = false,
        ?string $placeholder = null,
    ): TextColumn {

        return TextColumn::make($name)
            ->label($label ? __($label) : null)
            ->when($badge, fn ($column) => $column->badge())
            ->toggleable($toggleable, isToggledHiddenByDefault: $defaultHidden)
            ->placeholder($placeholder);
    }

    /*
    |--------------------------------------------------------------------------
    | Variants
    |--------------------------------------------------------------------------
    */

    public static function default(
        string $name,
        ?string $label = null,
    ): TextColumn {

        return self::make(
            name: $name,
            label: $label,
            placeholder: __('No date'),
        );
    }

    public static function createdAt(
        string $name = 'created_at_formatted',
        ?string $label = 'Created at',
    ): TextColumn {

        return self::make(
            name: $name,
            label: $label,
            badge: true,
            placeholder: __('No date'),
        );
    }

    public static function updatedAt(
        string $name = 'updated_at',
        ?string $label = 'Updated at',
    ): TextColumn {

        return self::make(
            name: $name,
            label: $label,
            badge: true,
            placeholder: __('No date'),
        );
    }
}