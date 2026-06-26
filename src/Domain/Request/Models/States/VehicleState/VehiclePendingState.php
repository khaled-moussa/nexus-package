<?php

namespace Nexus\Domain\Request\Models\States\VehicleState;

use Filament\Support\Colors\Color;

class VehiclePendingState extends VehicleStates
{
    public static function value(): string
    {
        return self::class;
    }

    public static function label(): string
    {
        return __('Pending');
    }

    public static function colorClass(): string
    {
        return 'warning';
    }

    public static function filamentColor(): array
    {
        return Color::Amber;
    }

    public static function colorCode(): string
    {
        return '#f59e0b';
    }
}
