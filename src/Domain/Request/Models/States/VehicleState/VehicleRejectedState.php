<?php

namespace Nexus\Domain\Request\Models\States\VehicleState;

use Filament\Support\Colors\Color;

class VehicleRejectedState extends VehicleStates
{
    public static function value(): string
    {
        return self::class;
    }

    public static function label(): string
    {
        return __('Rejected');
    }

    public static function colorClass(): string
    {
        return 'danger';
    }

    public static function colorFilament(): array
    {
        return Color::Red;
    }

    public static function colorCode(): string
    {
        return '#ef4444';
    }
}
