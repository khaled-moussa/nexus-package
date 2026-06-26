<?php

namespace Nexus\Filament\Components\Tables\Columns;

use Closure;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;

class TenantColumn
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
        ?Closure $searchableQuery = null,
        ?Closure $state = null,
    ): TextColumn {

        return NameColumn::make(
            name: $name,
            label: $label,
            searchable: $searchable,
            searchableQuery: $searchableQuery,
            state: $state,
        );
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
    | Company Brand Variant
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
            state: fn () => config('company.brand_name'),
        );
    }
}