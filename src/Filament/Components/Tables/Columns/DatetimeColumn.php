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
            ->toggleable($toggleable, isToggledHiddenByDefault: $defaultHidden)
            ->when($label,       fn(TextColumn $column) => $column->label(__($label)))
            ->when($badge,       fn(TextColumn $column) => $column->badge())
            ->when($placeholder, fn(TextColumn $column) => $column->placeholder(__($placeholder)));
    }



    /*
    |-------------------------
    | Default Variant
    |-------------------------
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

    /*
    |-------------------------
    | Created At Variant
    |-------------------------
    */

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

    /*
    |-------------------------
    | Updated At Variant
    |-------------------------
    */

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
