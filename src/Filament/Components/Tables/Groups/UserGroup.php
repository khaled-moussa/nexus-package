<?php

namespace Nexus\Filament\Components\Tables\Groups;

use Filament\Tables\Grouping\Group;
use Closure;

class UserGroup
{
    /*
    |--------------------------------------------------------------------------
    | Base Builder
    |--------------------------------------------------------------------------
    */

    public static function make(
        string $field,
        ?string $label = null,
        ?Closure $titleUsing = null,
    ): Group {

        $group = Group::make($field)
            ->titlePrefixedWithLabel(false)
            ->when($label, fn(Group $group) => $group->label(__($label)));

        if ($titleUsing) {
            $group->getTitleFromRecordUsing($titleUsing);
        }

        return $group;
    }



    /*
    |-------------------------
    | Active
    |-------------------------
    */

    public static function active(
        string $field = 'is_active',
        ?string $label = 'Active',
    ): Group {

        return self::make(
            field: $field,
            label: $label,
            titleUsing: fn($state) => filled($state) ? __('Active') : __('Not Active'),
        );
    }

    /*
    |-------------------------
    | Email Verified
    |-------------------------
    */

    public static function emailVerified(
        string $field = 'email_verified_at',
        ?string $label = 'Email Verified',
    ): Group {

        return self::make(
            field: $field,
            label: $label,
            titleUsing: fn($state) => filled($state) ? __('Verified') : __('Not Verified'),
        );
    }

    /*
    |-------------------------
    | Gender Verified
    |-------------------------
    */

    public static function gender(
        string $field = 'gender',
        ?string $label = 'Gender',
    ): Group {

        return self::make(
            field: $field,
            label: $label,
            titleUsing: fn($record) => $record?->getGender()->label() ?? __('Unknown'),
        );
    }
}
