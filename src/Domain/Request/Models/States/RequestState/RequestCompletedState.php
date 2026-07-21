<?php

namespace Nexus\Domain\Request\Models\States\RequestState;

use Filament\Support\Colors\Color;

class RequestCompletedState extends RequestStates
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
        return 'completed';
    }

    public static function colorFilament(): array
    {
        return Color::Emerald;
    }

    public static function colorCode(): string
    {
        return '#059669';
    }

    public static function colorChart(): array
    {
        return [
            'background' => 'rgba(5, 150, 105, 0.06)',
            'border' => 'rgba(5, 150, 105, 0.6)',
        ];
    }
}
