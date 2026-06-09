<?php

namespace Nexus\Domain\User\Enums;

use Filament\Support\Colors\Color;

enum GenderEnum: string
{
    case MALE = 'male';
    case FEMALE = 'female';

    /*
    |--------------------------------------------------------------------------
    | Label
    |--------------------------------------------------------------------------
    */

    public function label(): string
    {
        return match ($this) {
            self::MALE => 'Male',
            self::FEMALE => 'Female',
        };
    }

    /*
    |--------------------------------------------------------------------------
    | Color
    |--------------------------------------------------------------------------
    */

    public function filamentColor(): array
    {
        return match ($this) {
            self::MALE => Color::Blue,
            self::FEMALE => Color::Pink,
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
            ->mapWithKeys(fn (self $case) => [
                $case->value => $case->label(),
            ])
            ->toArray();
    }

    public static function values(): array
    {
        return collect(self::cases())
            ->map(fn (self $case) => $case->value)
            ->values()
            ->toArray();
    }
}