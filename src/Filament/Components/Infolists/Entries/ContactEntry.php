<?php

namespace Nexus\Filament\Components\Infolists\Entries;

use Filament\Infolists\Components\TextEntry;
use Filament\Support\Icons\Heroicon;

class ContactEntry
{
    /*
    |--------------------------------------------------------------------------
    | Base Builder
    |--------------------------------------------------------------------------
    */

    public static function make(
        string $name,
        ?string $label = null,
        bool $hiddenLabel = false,
        bool $copyable = true,
        ?Heroicon $icon = null,
        ?string $placeholder = null,
    ): TextEntry {

        return TextEntry::make($name)
            ->label($label ? __($label) : null)
            ->hiddenLabel($hiddenLabel)
            ->placeholder($placeholder)
            ->when($icon, fn ($entry) => $entry->icon($icon))
            ->when($copyable, fn ($entry) => $entry->copyable());
    }

    /*
    |--------------------------------------------------------------------------
    | Email Variant
    |--------------------------------------------------------------------------
    */

    public static function email(
        string $name = 'email',
        ?string $label = 'Email',
        bool $copyable = true,
    ): TextEntry {

        return self::make(
            name: $name,
            label: $label,
            placeholder: __('No email'),
            copyable: $copyable,
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
        bool $copyable = true,
    ): TextEntry {

        return self::make(
            name: $name,
            label: $label,
            placeholder: __('No phone'),
            copyable: $copyable,
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Generic Contact (fully flexible)
    |--------------------------------------------------------------------------
    */

    public static function custom(
        string $name,
        ?string $label = null,
        ?Heroicon $icon = null,
        ?string $placeholder = null,
        bool $copyable = true,
    ): TextEntry {

        return self::make(
            name: $name,
            label: $label,
            icon: $icon,
            placeholder: $placeholder,
            copyable: $copyable,
        );
    }
}