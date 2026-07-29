<?php

namespace Nexus\Filament\Components\Tables\Columns;

use Closure;
use Filament\Support\Colors\Color;
use Filament\Tables\Columns\IconColumn as BaseIconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Support\Icons\Heroicon;

class RequestColumn
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
    | Vehicles Quotation State
    |--------------------------------------------------------------------------
    */

    public static function vehiclesQuotationState(
        string $name = 'has_quotation',
        ?string $label = 'Quotation Found',
    ): BaseIconColumn {
        return IconColumn::make($name)
            ->label(__($label))
            ->trueIcon(Heroicon::OutlinedXCircle)
            ->falseIcon(Heroicon::OutlinedCheckCircle)
            ->trueColor('danger')
            ->falseColor('success')
            ->tooltip(fn(bool $state): string => $state ? __('No quotation found for one or more vehicles.')  : __('All vehicles have quotations.'));
    }

    /*
    |--------------------------------------------------------------------------
    | Accepted Quotation Count
    |--------------------------------------------------------------------------
    */

    public static function acceptedQuotationsCount(
        string $name = 'accepted_vehicle_quotations',
        ?string $label = 'Vehicles',
        bool $badge = true,
        bool $toggleable = true,
        bool $defaultHidden = false,
    ): TextColumn {
        return CountColumn::make(
            name: $name,
            label: $label,
            badge: $badge,
            toggleable: $toggleable,
            defaultHidden: $defaultHidden,
            formatUsing: fn($state, $record) => "{$record->vehicles_count} / {$state}",
        );
    }
}
