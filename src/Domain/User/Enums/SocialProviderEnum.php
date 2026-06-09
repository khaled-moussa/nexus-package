<?php

namespace Nexus\Domain\User\Enums;

use Nexus\Domain\User\Models\User;

enum SocialProviderEnum: string
{
    case GOOGLE = 'google';

    /*
    |--------------------------------------------------------------------------
    | Label
    |--------------------------------------------------------------------------
    */

    public function label(): string
    {
        return match ($this) {
            self::GOOGLE     => 'Google',
        };
    }

    /*
    |--------------------------------------------------------------------------
    | Icon
    |--------------------------------------------------------------------------
    */

    public function icon(): string
    {
        return match ($this) {
            self::GOOGLE     => 'fab-google',
        };
    }

    /*
    |--------------------------------------------------------------------------
    | Options
    |--------------------------------------------------------------------------
    */

    public static function options(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn(self $provider) => [
                $provider->value => $provider->label(),
            ])
            ->all();
    }

    public static function values(): array
    {
        return collect(self::cases())
            ->map(fn(self $case) => $case->value)
            ->values()
            ->toArray();
    }
}
