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
        return 'success';
    }

    public static function colorFilamentUpdate(): array
    {
        return Color::Green;
    }

    public static function colorCode(): string
    {
        return '#22c55e';
    }

    public static function colorChart(): array
    {
        return [
            'background' => 'rgba(59, 130, 246, 0.06)',
            'border' => 'rgba(59, 130, 246, 0.6)',
        ];
    }
}
