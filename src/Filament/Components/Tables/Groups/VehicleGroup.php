<?php

namespace Nexus\Filament\Components\Tables\Groups;

use Filament\Tables\Grouping\Group;

class VehicleGroup
{
    /*
    |--------------------------------------------------------------------------
    | Base Builder
    |--------------------------------------------------------------------------
    */

    public static function make(
        string $field,
        ?string $label = null,
        ?\Closure $titleUsing = null,
    ): Group {

        $group = Group::make($field)
            ->label($label ? __($label) : null)
            ->titlePrefixedWithLabel(false);

        return $titleUsing
            ? $group->getTitleFromRecordUsing($titleUsing)
            : $group;
    }

    /*
    |--------------------------------------------------------------------------
    | Manufacturer
    |--------------------------------------------------------------------------
    */

    public static function manufacturer(
        string $field = 'manufacturer',
        ?string $label = 'Manufacturer',
    ): Group {

        return self::make(
            field: $field,
            label: $label,
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Model Year
    |--------------------------------------------------------------------------
    */

    public static function modelYear(
        string $field = 'model_year',
        ?string $label = 'Model Year',
    ): Group {

        return self::make(
            field: $field,
            label: $label,
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Service Type (Enum-aware)
    |--------------------------------------------------------------------------
    */

    public static function serviceType(
        string $field = 'service_type',
        ?string $label = 'Service Type',
    ): Group {

        return self::make(
            field: $field,
            label: $label,
            titleUsing: fn($state) => $state?->label(),
        );
    }
}
