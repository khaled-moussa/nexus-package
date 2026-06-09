<?php

namespace Nexus\Filament\Components\Tables\Columns;

use Closure;
use Filament\Tables\Columns\TextColumn;

class ContactColumn
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
        Closure|string|null $url = null,
        bool $copyable = true,
        bool $searchable = true,
        ?string $placeholder = '—',
    ): TextColumn {

        return TextColumn::make($name)
            ->label($label ? __($label) : null)
            ->description($description)
            ->placeholder($placeholder ? __($placeholder) : null)
            ->when($url, fn($column) => $column->url($url))
            ->when($copyable, fn($column) => $column->copyable())
            ->when($searchable, fn($column) => $column->searchable());
    }

    /*
    |--------------------------------------------------------------------------
    | Email Variant
    |--------------------------------------------------------------------------
    */

    public static function email(
        string $name = 'email',
        ?string $label = 'Email',
    ): TextColumn {

        return self::make(
            name: $name,
            label: $label,
            url: fn($state) => filled($state) ? "mailto:{state}" : null,
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Phone Variant
    |--------------------------------------------------------------------------
    */

    public static function phone(
        string $name = 'phone',
        ?string $label = 'Phone',
    ): TextColumn {

        return self::make(
            name: $name,
            label: $label,
            url: fn($state) => filled($state) ? "tel:{state}" : null,
            placeholder: 'No phone'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Custom Variant
    |--------------------------------------------------------------------------
    */

    public static function custom(
        string $name,
        ?Closure $url = null,
        ?string $label = null,
    ): TextColumn {

        return self::make(
            name: $name,
            label: $label,
            url: $url,
        );
    }
}
