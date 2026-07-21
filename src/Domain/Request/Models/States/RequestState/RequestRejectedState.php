<?php

namespace Nexus\Domain\Request\Models\States\RequestState;

use Filament\Support\Colors\Color;

class RequestRejectedState extends RequestStates
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
        return 'rejected';
    }

    public static function colorFilament(): array
    {
        return Color::Red;
    }

    public static function colorCode(): string
    {
        return '#ef4444';
    }

    public static function colorChart(): array
    {
        return [
            'background' => 'rgba(239, 68, 68, 0.06)',
            'border' => 'rgba(239, 68, 68, 0.6)',
        ];
    }
}
