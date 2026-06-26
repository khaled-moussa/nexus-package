<?php

namespace Nexus\Domain\Request\Models\States\VehicleState;

use Filament\Support\Colors\Color;

class VehicleAcceptedState extends VehicleStates
{
    public static function value(): string
    {
        return self::class;
    }

    public static function label(): string
    {
        return __('Accepted');
    }

    public static function colorClass(): string
    {
        return 'success';
    }

    public static function filamentColor(): array
    {
        return Color::Green;
    }

    public static function colorCode(): string
    {
        return '#10b981';
    }
}
