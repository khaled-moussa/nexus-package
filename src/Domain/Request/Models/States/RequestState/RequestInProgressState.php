<?php

namespace Nexus\Domain\Request\Models\States\RequestState;

use Filament\Support\Colors\Color;

class RequestInProgressState extends RequestStates
{
    public static function value(): string
    {
        return self::class;
    }

    public static function label(): string
    {
        return __( 'In Progress');
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

    public static function colorChart(): array
    {
        return [
            'background' => 'rgba(59, 130, 246, 0.06)',
            'border' => 'rgba(59, 130, 246, 0.6)',
        ];
    }
}
