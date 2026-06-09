<?php

namespace Nexus\Filament\Components\Tables\Filters;

use Filament\Tables\Filters\SelectFilter;
use Nexus\Domain\User\Enums\GenderEnum;
use Filament\Tables\Filters\TernaryFilter;

class UserFilter
{
    /*
    |--------------------------------------------------------------------------
    | Gender
    |--------------------------------------------------------------------------
    */

    public static function gender(
        string $name = 'gender',
        ?string $label = null,
    ): SelectFilter {

        return SelectFilter::make($name)
            ->label($label ? __($label) : __('Gender'))
            ->options(GenderEnum::options())
            ->native(false);
    }

    /*
    |--------------------------------------------------------------------------
    | Email Verified
    |--------------------------------------------------------------------------
    */

    public static function emailVerified(
        string $name = 'email_verified_at',
        ?string $label = null,
    ): TernaryFilter {

        return TernaryFilter::make($name)
            ->label($label ? __($label) : __('Email Verified'))
            ->nullable()
            ->native(false);
    }
}
