<?php

namespace Nexus\Filament\Components\Tables\Columns;

use Filament\Support\Colors\Color;
use Filament\Tables\Columns\IconColumn as BaseIconColumn;
use Filament\Tables\Columns\TextColumn;
use Closure;
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
    |-------------------------
    | Vehicles Quotation State
    |-------------------------
    */

    public static function vehiclesQuotationState(): BaseIconColumn
    {
        return IconColumn::make('has_quotation')
            ->label('Quotation Found')
            ->trueIcon(Heroicon::OutlinedCheckCircle)
            ->falseIcon(Heroicon::OutlinedXCircle)
            ->trueColor('success')
            ->falseColor('danger')
            ->tooltip(
                fn(bool $state): string => $state
                    ? 'All vehicles have quotations.'
                    : 'No quotation found for one or more vehicles.'
            );
    }
}
