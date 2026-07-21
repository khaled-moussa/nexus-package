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
        return 'received';
    }

    public static function colorFilament(): array
    {
        return Color::Sky;
    }

    public static function colorCode(): string
    {
        return '#0ea5e9';
    }

    public static function colorChart(): array
    {
        return [
            'background' => 'rgba(14, 165, 233, 0.06)',
            'border' => 'rgba(14, 165, 233, 0.6)',
        ];
    }
}
