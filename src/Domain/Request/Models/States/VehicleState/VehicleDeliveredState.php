<?php

namespace Nexus\Domain\Request\Models\States\VehicleState;

use Filament\Support\Colors\Color;

class VehicleDeliveredState extends VehicleStates
{
    public static function value(): string
    {
        return self::class;
    }

    public static function label(): string
    {
        return __('Delivered');
    }

    public static function colorClass(): string
    {
        return 'indigo';
    }

    public static function colorFilament(): array
    {
        return Color::Indigo;
    }

    public static function colorCode(): string
    {
        return '#6366F1';
    }
}
