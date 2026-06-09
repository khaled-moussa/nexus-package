<?php

namespace Nexus\Domain\Request\Models\States\VehicleState;

use Filament\Support\Colors\Color;

class VehicleInProgressState extends VehicleStates
{
    public static function value(): string
    {
        return self::class;
    }

    public static function label(): string
    {
        return __('In Progress');
    }

    public static function colorClass(): string
    {
        return 'primary';
    }

    public static function filamentColor(): array
    {
        return Color::Blue;
    }

    public static function colorCode(): string
    {
        return '#3b82f6';
    }
}
