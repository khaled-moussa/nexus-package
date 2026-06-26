<?php

namespace Nexus\Filament\Components\Tables\Columns;

use Filament\Tables\Columns\TextColumn;
use Closure;

class UserColumn
{
    /*
    |--------------------------------------------------------------------------
    | Gender
    |--------------------------------------------------------------------------
    */

    public static function gender(
        string $name = 'gender',
        ?string $label = 'Gender',
    ): TextColumn {

        return TextColumn::make($name)
            ->badge()
            ->color(fn($state) => $state?->colorFilamentUpdate())
            ->formatStateUsing(fn($state) => $state?->label())
            ->placeholder(__('No gender'))
            ->when($label, fn(TextColumn $column) => $column->label(__($label)));
    }

    /*
    |--------------------------------------------------------------------------
    | Name / Identity
    |--------------------------------------------------------------------------
    */

    public static function name(
        string $name = 'full_name',
        ?string $label = 'Full name',
        ?Closure $description = null,
    ): TextColumn {

        return NameColumn::make(
            name: $name,
            label: $label,
            description: $description,
            bold: true,
            limit: 40,
            tooltip: true
        );
    }

    public static function creator(
        string $name = 'full_name',
        ?string $label = 'Full name',
        ?Closure $description = null,
    ): TextColumn {

        return NameColumn::make(
            name: $name,
            label: $label,
            description: $description,
            bold: true,
            limit: 40,
            tooltip: true,
            searchableQuery: fn($query, $search) => $query->orWhereRelation('creator', 'full_name', 'like', "%{$search}%")
        );
    }
}
