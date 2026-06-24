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
        ?string $label = 'Gender',
    ): SelectFilter {

        return SelectFilter::make($name)
            ->options(GenderEnum::options())
            ->native(false)
            ->when($label, fn(SelectFilter $filter) => $filter->label(__($label)));
    }

    /*
    |--------------------------------------------------------------------------
    | Email Verified
    |--------------------------------------------------------------------------
    */

    public static function emailVerified(
        string $name = 'email_verified_at',
        ?string $label = 'Email Verified',
    ): TernaryFilter {

        return TernaryFilter::make($name)
            ->nullable()
            ->native(false)
            ->when($label, fn(SelectFilter $filter) => $filter->label(__($label)));
    }
}
