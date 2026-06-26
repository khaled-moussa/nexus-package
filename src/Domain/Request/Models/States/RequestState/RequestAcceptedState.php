<?php

namespace Nexus\Domain\Request\Models\States\RequestState;

use Filament\Support\Colors\Color;

class RequestAcceptedState extends RequestStates
{
    public static function value(): string
    {
        return self::class;
    }

    public static function label(): string
    {
        return __('Accepted');
    }

    public static function colorClass(): string
    {
        return 'success';
    }

    public static function filamentColor(): array
    {
        return Color::Green;
    }

    public static function colorCode(): string
    {
        return '#10b981';
    }

    public static function colorChart(): array
    {
        return [
            'background' => 'rgba(16, 185, 129, 0.06)',
            'border' =>   'rgba(16, 185, 129, 0.6)'
        ];
    }
}
