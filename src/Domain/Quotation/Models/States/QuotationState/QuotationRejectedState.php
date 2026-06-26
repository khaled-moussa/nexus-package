<?php

namespace Nexus\Domain\Quotation\Models\States\QuotationState;

use Filament\Support\Colors\Color;

class QuotationRejectedState extends QuotationStates
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

    public static function colorFilamentUpdate(): array
    {
        return Color::Red;
    }

    public static function colorCode(): string
    {
        return '#ef4444';
    }
}
