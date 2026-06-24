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
            ->hiddenLabel($hiddenLabel)
            ->when($label,       fn(TextEntry $field) => $field->label(__($label)))
            ->when($icon,        fn(TextEntry $entry) => $entry->icon($icon))
            ->when($copyable,    fn(TextEntry $entry) => $entry->copyable())
            ->when($placeholder, fn(TextEntry $entry) => $entry->placeholder(__($placeholder)));
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
        bool $copyable = true,
    ): TextEntry {

        return self::make(
            name: $name,
            label: $label,
            placeholder: 'No email',
            copyable: $copyable,
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
        bool $copyable = true,
    ): TextEntry {

        return self::make(
            name: $name,
            label: $label,
            placeholder: 'No phone',
            copyable: $copyable,
        );
    }
}
