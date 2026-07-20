<?php

namespace Nexus\Domain\Request\Models\States\RequestState;

use Filament\Support\Colors\Color;

class RequestDeliveredState extends RequestStates
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

    public static function colorChart(): array
    {
        return [
            'background' => 'rgba(99, 102, 241, 0.06)',
            'border'     => 'rgba(99, 102, 241, 0.6)',
        ];
    }
}