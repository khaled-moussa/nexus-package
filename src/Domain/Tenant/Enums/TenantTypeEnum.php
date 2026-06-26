<?php

namespace Nexus\Domain\Tenant\Enums;

use Filament\Support\Colors\Color;

enum TenantTypeEnum: string
{
    case ORGANIZATION = 'organization';
    case INTERNAL_WORKSHOP = 'internal_workshop';
    case EXTERNAL_WORKSHOP = 'external_workshop';

    /*
    |--------------------------------------------------------------------------
    | Label
    |--------------------------------------------------------------------------
    */

    public function label(): string
    {
        return match ($this) {
            self::ORGANIZATION => 'Organization',
            self::INTERNAL_WORKSHOP => 'Internal Workshop',
            self::EXTERNAL_WORKSHOP => 'External Workshop',
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
            self::ORGANIZATION => Color::Indigo,
            self::INTERNAL_WORKSHOP => Color::Emerald,
            self::EXTERNAL_WORKSHOP => Color::Amber,
        };
    }

    /*
    |--------------------------------------------------------------------------
    | Collections
    |--------------------------------------------------------------------------
    */

    public static function options(array $exclude = []): array
    {
        return collect(self::cases())
            ->reject(fn(self $case) => in_array($case, $exclude, true))
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
