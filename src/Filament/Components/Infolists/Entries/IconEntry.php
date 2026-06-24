<?php

namespace Nexus\Filament\Components\Infolists\Entries;

use Filament\Infolists\Components\IconEntry as BaseIconEntry;
use Filament\Support\Icons\Heroicon;

class IconEntry
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
        bool $boolean = false,
    ): BaseIconEntry {

        return BaseIconEntry::make($name)
            ->hiddenLabel($hiddenLabel)
            ->when($label,   fn(BaseIconEntry $entry) => $entry->label(__($label)))
            ->when($boolean, function (BaseIconEntry $entry) {
                $entry->trueIcon(Heroicon::OutlinedCheckCircle);
                $entry->falseIcon(Heroicon::OutlinedXCircle);
            });
    }

    /*
    |--------------------------------------------------------------------------
    | Variants
    |--------------------------------------------------------------------------
    */

    /*
    |-------------------------
    | Active Variant
    |-------------------------
    */

    public static function active(
        string $name = 'is_active',
        ?string $label = 'Active',
    ): BaseIconEntry {

        return self::make(
            name: $name,
            label: $label,
            boolean: true
        );
    }

    /*
    |-------------------------
    | Email Verified Variant
    |-------------------------
    */

    public static function emailVerified(
        string $name = 'is_email_verified',
        ?string $label = 'Email Verified',
    ): BaseIconEntry {

        return self::make(
            name: $name,
            label: $label,
            boolean: true
        );
    }
}
