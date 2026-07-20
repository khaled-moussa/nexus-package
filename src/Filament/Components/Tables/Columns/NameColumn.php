<?php

namespace Nexus\Filament\Components\Tables\Columns;

use Filament\Support\Enums\FontWeight;
use Filament\Tables\Columns\TextColumn;
use Filament\Support\Colors\Color;
use Closure;

class NameColumn
{
    /*
    |--------------------------------------------------------------------------
    | Base Builder
    |--------------------------------------------------------------------------
    */

    public static function make(
        string $name,
        ?string $label = null,
        string|Closure|null $description = null,
        string|Closure|null $state = null,
        bool $bold = true,
        bool $badge = false,
        bool $tooltip = false,
        ?string $limit = null,
        bool $searchable = true,
        string|Color|array|null $color = null,
        ?Closure $searchableQuery = null,
    ): TextColumn {

        return TextColumn::make($name)
            ->when($label,       fn(TextColumn $column) => $column->label(__($label)))
            ->when($state,       fn(TextColumn $column) => $column->state($state))
            ->when($bold,        fn(TextColumn $column) => $column->weight(FontWeight::Medium))
            ->when($color,       fn(TextColumn $column) => $column->color($color))
            ->when($badge,       fn(TextColumn $column) => $column->badge())
            ->when($limit,       fn(TextColumn $column) => $column->limit($limit))
            ->when($tooltip,     fn(TextColumn $column) => $column->tooltip(fn($state) => $state))
            ->when($searchable,  fn(TextColumn $column) => $column->searchable($searchable, $searchableQuery))
            ->when(!is_null($description), fn(TextColumn $column) => $column->description($description));
    }


    /*
    |--------------------------------------------------------------------------
    | Company Brand
    |--------------------------------------------------------------------------
    */

    public static function companyBrand(
        string $name = 'company_brand',
        ?string $label = 'Organization',
    ): TextColumn {
        return self::make(
            name: $name,
            label: $label,
        )->state(fn() => config('company.brand.name'));
    }
}
