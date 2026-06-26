<?php

namespace Nexus\Filament\Components\Tables\Columns;

use Closure;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;

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
        bool $searchable = true,
        bool $sortable = true,
        bool $copyable = false,
        ?Closure $state = null,
        ?Closure $searchableQuery = null,
    ): TextColumn {

        $column = TextColumn::make($name)
            ->label(__($label ?? str($name)->headline()))
            ->weight(FontWeight::SemiBold)
            ->color(Color::Slate)
            ->sortable($sortable)
            ->toggleable()
            ->searchable(
                condition: $searchable,
                query: $searchableQuery,
            );

        if ($copyable) {
            $column->copyable();
        }

        if ($state) {
            $column->state($state);
        }

        return $column;
    }

    /*
    |--------------------------------------------------------------------------
    | Organization Variant
    |--------------------------------------------------------------------------
    */

    public static function organization(
        string $name = 'organization_name',
        ?string $label = 'Organization',
    ): TextColumn {

        return self::make(
            name: $name,
            label: $label,
            searchableQuery: fn (Builder $query, string $search) => $query
                ->orWhereRelation(
                    'tenant',
                    'name',
                    'like',
                    "%{$search}%"
                ),
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Workshop Variant
    |--------------------------------------------------------------------------
    */

    public static function workshop(
        string $name = 'workshop_name',
        ?string $label = 'Workshop',
    ): TextColumn {

        return self::make(
            name: $name,
            label: $label,
            searchableQuery: fn (Builder $query, string $search) => $query
                ->orWhereRelation(
                    'tenant',
                    'name',
                    'like',
                    "%{$search}%"
                ),
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Company Variant
    |--------------------------------------------------------------------------
    */

    public static function companyBrand(
        string $name = 'company_brand',
        ?string $label = 'Company Name',
    ): TextColumn {

        return self::make(
            name: $name,
            label: $label,
            searchable: false,
            sortable: false,
            state: fn () => config('company.brand_name'),
        );
    }
}