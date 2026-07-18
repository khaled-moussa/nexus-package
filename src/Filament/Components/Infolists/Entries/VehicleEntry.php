<?php

namespace Nexus\Filament\Components\Infolists\Entries;

use Nexus\Filament\Components\Infolists\Entries\CountEntry;
use Nexus\Filament\Components\Infolists\Entries\NumericEntry;
use Nexus\Filament\Components\Infolists\Entries\StatusEntry;
use Nexus\Filament\Components\Infolists\Sections\CustomSection;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Support\Colors\Color;

class VehicleEntry
{
    /*
    |--------------------------------------------------------------------------
    | Base Builder
    |--------------------------------------------------------------------------
    */

    private static function make(
        string $name,
        string $label,
        bool $bold = false,
        bool $badge = false,
        string|Color|array|null $color = null,
        ?string $placeholder = null,
    ): TextEntry {

        return NameEntry::make(
            name: $name,
            label: $label,
            bold: $bold,
            badge: $badge,
            color: $color,
            placeholder: $placeholder,
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Vehicle Entries
    |--------------------------------------------------------------------------
    */

    /*
    |-------------------------
    | Manufacturer Entry
    |-------------------------
    */

    public static function manufacturer(
        string $name = 'manufacturer',
        string $label = 'Manufacturer'
    ): TextEntry {

        return self::make(
            name: $name,
            label: $label,
            bold: true,
        );
    }

    /*
    |-------------------------
    | Model Entry
    |-------------------------
    */

    public static function model(
        string $name = 'model',
        string $label = 'Model'
    ): TextEntry {

        return self::make(
            name: $name,
            label: $label,
        );
    }

    /*
    |-------------------------
    | Model Year Entry
    |-------------------------
    */

    public static function modelYear(
        string $name = 'model_year',
        string $label = 'Model Year'
    ): TextEntry {

        return self::make(
            name: $name,
            label: $label,
            badge: true,
            color: Color::Gray
        );
    }

    /*
    |-------------------------
    | Plate Number Entry
    |-------------------------
    */

    public static function plateNumber(
        string $name = 'plate_number',
        string $label = 'Plate Number'
    ): TextEntry {

        return self::make(
            name: $name,
            label: $label,
            badge: true,
            color: Color::Blue
        );
    }

    /*
    |-------------------------
    | Vin Number Entry
    |-------------------------
    */

    public static function vinNumber(
        string $name = 'vin_number',
        string $label = 'Vin Number'
    ): TextEntry {

        return self::make(
            name: $name,
            label: $label,
            badge: true,
            color: Color::Emerald
        );
    }

    /*
    |-------------------------
    | Kilometers VariEntryant
    |-------------------------
    */

    public static function kilometers(
        string $name = 'kilometers',
        string $label = 'Kilometers'
    ): TextEntry {

        return NumericEntry::number(
            name: $name,
            label: $label,
            suffix: __('KM'),
        );
    }

    /*
    |-------------------------
    | Service Entry
    |-------------------------
    */

    public static function serviceType(
        string $name = 'service_type',
        string $label = 'Service Type'
    ): TextEntry {

        return StatusEntry::enum(
            name: $name,
            label: $label,
        );
    }

    /*
    |-------------------------
    | State Entry
    |-------------------------
    */

    public static function vehicleState(
        string $name = 'vehicle_state',
        string $label = 'Vehicle State'
    ): TextEntry {

        return StatusEntry::enum(
            name: $name,
            label: $label,
        );
    }

    /*
    |-------------------------
    | Maintenance Count Entry
    |-------------------------
    */

    public static function maintenanceCount(
        string $name = 'maintenance_count',
        string $label = 'Vehicle State'
    ): TextEntry {

        return CountEntry::badge(
            name: $name,
            label: $label,
        );
    }

    /*
    |-------------------------
    | Issue Entry
    |-------------------------
    */

    public static function vehicleDescription(
        string $name = 'issue_description',
        string $label = 'Issue Description'
    ): TextEntry {

        return DescriptionEntry::make(
            name: $name,
            label: $label,
        );
    }

    /*
    |-------------------------
    | Comments Entry
    |-------------------------
    */

    public static function vehicleComment(
        string $name = 'comments',
        string $label = 'Comments'
    ): TextEntry {

        return DescriptionEntry::make(
            name: $name,
            label: $label,
        );
    }



    /*
    |--------------------------------------------------------------------------
    | Ready Sections
    |--------------------------------------------------------------------------
    */

    /*
    |-------------------------
    | Issue & Comment Section
    |-------------------------
    */

    public static function issueAndCommentSection(): Section
    {
        return CustomSection::make(__('Issue & Comments'))
            ->schema([
                self::vehicleDescription(),
                self::vehicleComment(),
            ]);
    }
}
