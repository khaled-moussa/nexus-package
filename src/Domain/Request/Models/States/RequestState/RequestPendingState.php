<?php

namespace Nexus\Domain\Request\Models\States\RequestState;

use Filament\Support\Colors\Color;

class RequestPendingState extends RequestStates
{
    public static function value(): string
    {
        return self::class;
    }

    public static function label(): string
    {
        return __('Pending');
    }

    public static function colorClass(): string
    {
        return 'warning';
    }

    public static function filamentColor(): array
    {
        return Color::Amber;
    }

    public static function colorCode(): string
    {
        return '#f59e0b';
    }

    public static function colorChart(): array
    {
        return [
            'background' => 'rgba(245, 158, 11, 0.06)',
            'border' =>  'rgba(245, 158, 11, 0.6)'
        ];
    }
}
