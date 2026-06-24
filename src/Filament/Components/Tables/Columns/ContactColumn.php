<?php

namespace Nexus\Filament\Components\Tables\Columns;

use Filament\Tables\Columns\TextColumn;
use Closure;

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
        bool $copyable = true,
        bool $searchable = true,
        Closure|string|null $url = null,
        ?string $placeholder = null,
    ): TextColumn {

        return TextColumn::make($name)
            ->description($description)
            ->when($label,       fn(TextColumn $column) => $column->label(__($label)))
            ->when($url,         fn(TextColumn $column) => $column->url($url))
            ->when($copyable,    fn(TextColumn $column) => $column->copyable())
            ->when($searchable,  fn(TextColumn $column) => $column->searchable())
            ->when($placeholder, fn(TextColumn $column) => $column->placeholder(__($placeholder)));
    }

    /*
    |--------------------------------------------------------------------------
    | Variants
    |--------------------------------------------------------------------------
    */

    /*
    |-------------------------
    | Email Variant
    |-------------------------
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
    |-------------------------
    | Phone Variant
    |-------------------------
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
    |-------------------------
    | Custom Variant
    |-------------------------
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
