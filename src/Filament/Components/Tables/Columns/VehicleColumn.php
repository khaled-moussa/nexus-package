<?php

namespace Nexus\Filament\Components\Tables\Columns;

use Closure;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Columns\TextColumn;

class VehicleColumn
{
    /*
    |--------------------------------------------------------------------------
    | Manufacturer
    |--------------------------------------------------------------------------
    */

    public static function manufacturer(
        string $name = 'manufacturer',
        ?string $label = 'Manufacturer',
    ): TextColumn {

        return TextColumn::make($name)
            ->label($label ? __($label) : null)
            ->weight(FontWeight::Bold)
            ->searchable();
    }

    /*
    |--------------------------------------------------------------------------
    | Model
    |--------------------------------------------------------------------------
    */

    public static function model(
        string $name = 'model',
        ?string $label = 'Model',
        ?Closure $description = null,
    ): TextColumn {

        return TextColumn::make($name)
            ->label($label ? __($label) : null)
            ->description($description)
            ->searchable();
    }

    /*
    |--------------------------------------------------------------------------
    | Model Year
    |--------------------------------------------------------------------------
    */

    public static function modelYear(
        string $name = 'model_year',
        ?string $label = 'Model Year',
    ): TextColumn {

        return TextColumn::make($name)
            ->label($label ? __($label) : null)
            ->badge()
            ->color(Color::Gray);
    }

    /*
    |--------------------------------------------------------------------------
    | Plate Number
    |--------------------------------------------------------------------------
    */

    public static function plateNumber(
        string $name = 'plate_number',
        ?string $label = 'Plate No',
    ): TextColumn {

        return TextColumn::make($name)
            ->label($label ? __($label) : null)
            ->badge()
            ->color(Color::Blue)
            ->searchable();
    }

    /*
    |--------------------------------------------------------------------------
    | Vin Number
    |--------------------------------------------------------------------------
    */

    public static function vinNumber(
        string $name = 'vin_number',
        ?string $label = 'Vin No',
    ): TextColumn {

        return TextColumn::make($name)
            ->label($label ? __($label) : null)
            ->badge()
            ->color(Color::Emerald)
            ->searchable();
    }

    /*
    |--------------------------------------------------------------------------
    | Maintenance Count
    |--------------------------------------------------------------------------
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
