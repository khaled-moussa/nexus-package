<?php

namespace Nexus\Domain\Quotation\Models\States\QuotationState;

use Filament\Support\Colors\Color;

class QuotationPendingState extends QuotationStates
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

    public static function colorFilament(): array
    {
        return Color::Amber;
    }

    public static function colorCode(): string
    {
        return '#f59e0b';
    }
}
