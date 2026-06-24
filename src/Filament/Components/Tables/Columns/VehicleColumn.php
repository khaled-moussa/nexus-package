<?php

namespace Nexus\Filament\Components\Tables\Columns;

use Filament\Support\Colors\Color;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Columns\TextColumn;
use Closure;

class VehicleColumn
{
    /*
    |--------------------------------------------------------------------------
    | Base Builder
    |--------------------------------------------------------------------------
    */

    public static function make(
        string $name,
        ?string $label,
        string|Closure|null $description = null,
        string|Color|array|null $color = null,
        ?bool $bold = false,
        bool $badge = false,
    ): TextColumn {

        return NameColumn::make(
            name: $name,
            label: $label,
            description: $description,
            bold: $bold,
            badge: $badge,
            color: $color,
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Variants
    |--------------------------------------------------------------------------
    */

    /*
    |-------------------------
    | Manufacturer Variant
    |-------------------------
    */

    public static function manufacturer(
        string $name = 'manufacturer',
        ?string $label = 'Manufacturer',
    ): TextColumn {

        return self::make(
            name: $name,
            label: $label
        );
    }

    /*
    |-------------------------
    | Model Variant
    |-------------------------
    */

    public static function model(
        string $name = 'model',
        ?string $label = 'Model',
        string|Closure|null $description = null,
    ): TextColumn {

        return self::make(
            name: $name,
            label: $label,
            description: $description,
        );
    }

    /*
    |-------------------------
    | Model Year Variant
    |-------------------------
    */

    public static function modelYear(
        string $name = 'model_year',
        ?string $label = 'Model Year',
    ): TextColumn {

        return self::make(
            name: $name,
            label: $label,
            badge: true,
        );
    }

    /*
    |-------------------------
    | Plate No Variant
    |-------------------------
    */

    public static function plateNumber(
        string $name = 'plate_number',
        ?string $label = 'Plate No',
    ): TextColumn {

        return self::make(
            name: $name,
            label: $label,
            badge: true,
        );
    }

    /*
    |-------------------------
    | Vin No Variant
    |-------------------------
    */

    public static function vinNumber(
        string $name = 'vin_number',
        ?string $label = 'Vin No',
    ): TextColumn {

        return self::make(
            name: $name,
            label: $label,
            badge: true,
            color: Color::Emerald,
        );
    }

    /*
    |-------------------------
    | Maintenance Count Variant
    |-------------------------
    */

    public static function maintenanceCount(
        string $name = 'maintenance_count',
        ?string $label = 'Maintenance Count',
    ): TextColumn {

        return CountColumn::make(
            name: $name,
            label: $label
        );
    }
}
