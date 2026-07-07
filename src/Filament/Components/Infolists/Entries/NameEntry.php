<?php

namespace Nexus\Filament\Components\Infolists\Entries;

use Closure;
use Filament\Infolists\Components\TextEntry;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\FontWeight;
use Filament\Support\Icons\Heroicon;

class NameEntry
{
    /*
    |--------------------------------------------------------------------------
    | Base Builder
    |--------------------------------------------------------------------------
    */

    public static function make(
        string $name,
        ?string $label                  = null,
        bool $hiddenLabel               = false,
        string|Closure|null $state      = null,
        bool $isSub                     = true,
        bool $bold                      = false,
        bool $badge                     = false,
        string|Color|array|null $color  = null,
        bool $copyable                  = false,
        ?string $placeholder            = null,
        ?string $separator              = null,
        string|Heroicon|null $icon      = null,
    ): TextEntry {
        return TextEntry::make($name)
            ->hiddenLabel($hiddenLabel)
            ->when($isSub,       fn(TextEntry $e) => $e->color(Color::Gray))
            ->when($label,       fn(TextEntry $e) => $e->label(__($label)))
            ->when($state,       fn(TextEntry $e) => $e->state($state))
            ->when($bold,        fn(TextEntry $e) => $e->weight(FontWeight::Bold))
            ->when($badge,       fn(TextEntry $e) => $e->badge())
            ->when($copyable,    fn(TextEntry $e) => $e->copyable())
            ->when($placeholder, fn(TextEntry $e) => $e->placeholder(__($placeholder)))
            ->when($separator,   fn(TextEntry $e) => $e->separator($separator))
            ->when($color,       fn(TextEntry $e) => $e->color($color))
            ->when($icon,        fn(TextEntry $e) => $e->icon($icon));
    }

    /*
    |--------------------------------------------------------------------------
    | Enum
    |--------------------------------------------------------------------------
    */

    public static function enum(
        string $name,
        ?string $label      = null,
        bool $hiddenLabel   = false,
        bool $badge         = false,
        ?string $placeholder = null,
    ): TextEntry {
        return self::make(
            name: $name,
            label: $label,
            hiddenLabel: $hiddenLabel,
            badge: $badge,
            placeholder: $placeholder,
        )
            ->color(fn($state) => $state->colorFilament())
            ->formatStateUsing(fn($state) => $state->label());
    }

    /*
    |--------------------------------------------------------------------------
    | Enum
    |--------------------------------------------------------------------------
    */

    public static function companyBrand(
        string $name = 'company_brand',
        ?string $label = 'Organization',
    ): TextEntry {
        return self::make(
            name: $name,
            label: $label,
        )->state(fn() => config('company.name'));
    }
}
