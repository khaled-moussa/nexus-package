<?php

namespace Nexus\Domain\Panel\Enums;

enum PanelTypeEnum: string
{
    case AUTH = 'auth';
    case ADMIN = 'admin';
    case ORGANIZATION = 'organization';
    case WORKSHOP = 'workshop';

    /*
    |--------------------------------------------------------------------------
    | Label
    |--------------------------------------------------------------------------
    */

    public function label(): string
    {
        return match ($this) {
            self::AUTH => 'Auth',
            self::ADMIN => 'Admin',
            self::ORGANIZATION => 'Organization',
            self::WORKSHOP => 'Workshop',
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
            ->toArray();
    }
}
