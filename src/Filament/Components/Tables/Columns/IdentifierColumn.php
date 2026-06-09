<?php

namespace Nexus\Filament\Components\Tables\Columns;

use Filament\Support\Enums\FontWeight;
use Filament\Tables\Columns\TextColumn;

class IdentifierColumn
{
    /*
    |--------------------------------------------------------------------------
    | Base Builder
    |--------------------------------------------------------------------------
    */

    public static function make(
        string $name,
        ?string $label = null,
        int $limit = 12,
        bool $copyable = true,
        bool $searchable = true,
    ): TextColumn {

        return TextColumn::make($name)
            ->label($label ? __($label) : null)
            ->weight(FontWeight::Bold)
            ->limit($limit)
            ->tooltip(fn ($state) => $state)
            ->when($copyable, fn ($column) => $column->copyable())
            ->when($searchable, fn ($column) => $column->searchable());
    }

    /*
    |--------------------------------------------------------------------------
    | Variants
    |--------------------------------------------------------------------------
    */

    public static function uuid(
        string $name = 'uuid',
        ?string $label = 'Ref',
    ): TextColumn {

        return self::make(
            name: $name,
            label: $label,
            limit: 12,
        );
    }
}