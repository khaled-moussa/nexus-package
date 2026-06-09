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
        return 'danger';
    }

    public static function filamentColor(): array
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
            'background' => 'rgba(245, 158, 11, 0.06)',
            'border' =>  'rgba(245, 158, 11, 0.06)'
        ];
    }
}
