<?php

namespace Nexus\Domain\Request\Enums;

use Filament\Support\Colors\Color;

enum VehicleServiceTypeEnum: string
{
    case REPAIR = 'repair';
    case PART_REPLACEMENT = 'part_replacement';
    case DIAGNOSTIC = 'diagnostic';

    /*
    |--------------------------------------------------------------------------
    | Labels
    |--------------------------------------------------------------------------
    */

    public function label(): string
    {
        return match ($this) {
            self::REPAIR => __('Repair'),
            self::PART_REPLACEMENT => __('Part Replacement'),
            self::DIAGNOSTIC => __('Diagnostic'),
        };
    }

    /*
    |--------------------------------------------------------------------------
    | Color
    |--------------------------------------------------------------------------
    */

    public function colorFilamentUpdate(): array
    {
        return match ($this) {
            self::REPAIR => Color::Red,
            self::PART_REPLACEMENT => Color::Amber,
            self::DIAGNOSTIC => Color::Gray,
        };
    }

    /*
    |--------------------------------------------------------------------------
    | Collections
    |--------------------------------------------------------------------------
    */

    public static function options(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn(self $case) => [
                $case->value => $case->label(),
            ])
            ->toArray();
    }

    public static function values(): array
    {
        return collect(self::cases())
            ->map(fn(self $case) => $case->value)
            ->values()
            ->toArray();
    }
}
