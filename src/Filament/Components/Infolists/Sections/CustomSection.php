<?php

namespace Nexus\Filament\Components\Infolists\Sections;

use Filament\Schemas\Components\Section;
use Closure;

class CustomSection
{
    /*
    |--------------------------------------------------------------------------
    | Base Section
    |--------------------------------------------------------------------------
    */

    public static function make(string|Closure|null $title = null, bool $compact = true, bool $secondary = true): Section
    {
        return Section::make($title)
            ->compact($compact)
            ->secondary($secondary)
            ->columnSpanFull();
    }

    /*
    |--------------------------------------------------------------------------
    | Presets
    |--------------------------------------------------------------------------
    */

    public static function default(string|Closure|null $title = null): Section
    {
        return self::make($title);
    }

    public static function secondary(string|Closure|null $title = null): Section
    {
        return self::make($title, false, true);
    }

    public static function compact(string|Closure|null $title = null): Section
    {
        return self::make($title, true, false);
    }
}
