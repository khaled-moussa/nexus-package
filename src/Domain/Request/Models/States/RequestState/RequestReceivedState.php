<?php

namespace Nexus\Domain\Request\Models\States\RequestState;

use Filament\Support\Colors\Color;

class RequestReceivedState extends RequestStates
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

    public static function colorFilamentUpdate(): array
    {
        return Color::Gray;
    }

    public static function colorCode(): string
    {
        return '#6b7280';
    }

    public static function colorChart(): array
    {
        return [
            'background' => 'rgba(107, 114, 128, 0.06)',
            'border' =>  'rgba(107, 114, 128, 0.6)'
        ];
    }
}
