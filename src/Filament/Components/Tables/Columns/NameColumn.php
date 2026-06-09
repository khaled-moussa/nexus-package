<?php

namespace Nexus\Filament\Components\Tables\Columns;

use Closure;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Columns\TextColumn;

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
        ?Closure $description = null,
        bool $searchable = true,
        ?Closure $searchableQuery = null,
        ?Closure $state = null,
    ): TextColumn {
        return TextColumn::make($name)
            ->label($label ? __($label) : null)
            ->state($state)
            ->description($description)
            ->searchable($searchable, $searchableQuery)
            ->weight(FontWeight::Medium)
            ->limit(40)
            ->tooltip(fn($state) => $state);
    }

    /*
    |--------------------------------------------------------------------------
    | Organization
    |--------------------------------------------------------------------------
    */

    public static function organization(
        string $name = 'organization_name',
        ?string $label = 'Organization',
    ): TextColumn {
        return self::make(
            name: $name,
            label: $label,
            searchableQuery: fn($query, $search) => $query->orWhereRelation(
                'tenant',
                'name',
                'like',
                "%{$search}%"
            ),
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Workshop
    |--------------------------------------------------------------------------
    */

    public static function workshop(
        string $name = 'workshop_name',
        ?string $label = 'Workshop',
    ): TextColumn {
        return self::make(
            name: $name,
            label: $label,
            searchableQuery: fn($query, $search) => $query->orWhereRelation(
                'tenant',
                'name',
                'like',
                "%{$search}%"
            ),
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    public static function companyBrand(
        string $name = 'company_brand',
        ?string $label = 'Organization Name',
    ): TextColumn {
        return self::make(
            name: $name,
            label: $label,
            state: fn() => config('company.brand_name'),
        );
    }
}
