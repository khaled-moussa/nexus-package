<?php

namespace Nexus\Domain\Request\Models\States\VehicleState;

use Filament\Support\Colors\Color;

class VehicleCompletedState extends VehicleStates
{
    public static function value(): string
    {
        return self::class;
    }

    public static function label(): string
    {
        return __('Completed');
    }

    public static function colorClass(): string
    {
        return 'success';
    }

    public static function colorFilament(): array
    {
        return Color::Green;
    }

    public static function colorCode(): string
    {
        return '#22c55e';
    }
}
