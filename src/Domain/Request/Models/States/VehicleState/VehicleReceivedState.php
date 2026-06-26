<?php

namespace Nexus\Domain\Request\Models\States\VehicleState;

use Filament\Support\Colors\Color;

class VehicleReceivedState extends VehicleStates
{
    public static function value(): string
    {
        return self::class;
    }

    public static function label(): string
    {
        return __('Received');
    }

    public static function colorClass(): string
    {
        return 'gray';
    }

    public static function filamentColor(): array
    {
        return Color::Gray;
    }

    public static function colorCode(): string
    {
        return '#6b7280';
    }
}