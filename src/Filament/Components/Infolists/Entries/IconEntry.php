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
    ): BaseIconEntry {

        return BaseIconEntry::make($name)
            ->label($label ? __($label) : null)
            ->hiddenLabel($hiddenLabel);
    }

    /*
    |--------------------------------------------------------------------------
    | Active State
    |--------------------------------------------------------------------------
    */

    public static function active(
        string $name = 'is_active',
        ?string $label = null,
    ): BaseIconEntry {

        return self::make($name, $label ?? __('Active'))
            ->boolean()
            ->trueIcon(Heroicon::OutlinedCheckCircle)
            ->falseIcon(Heroicon::OutlinedXCircle);
    }

    /*
    |--------------------------------------------------------------------------
    | Email Verified
    |--------------------------------------------------------------------------
    */

    public static function emailVerified(
        string $name = 'is_email_verified',
        ?string $label = null,
    ): BaseIconEntry {

        return self::make($name, $label ?? __('Email Verified'))
            ->boolean()
            ->formatStateUsing(fn ($state) => filled($state))
            ->trueIcon(Heroicon::OutlinedCheckCircle)
            ->falseIcon(Heroicon::OutlinedXCircle);
    }
}