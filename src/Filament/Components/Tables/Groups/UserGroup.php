<?php

namespace Nexus\Filament\Components\Tables\Groups;

use Filament\Tables\Grouping\Group;

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
        ?\Closure $titleUsing = null,
    ): Group {

        $group = Group::make($field)
            ->label($label ? __($label) : null)
            ->titlePrefixedWithLabel(false);

        return $titleUsing
            ? $group->getTitleFromRecordUsing($titleUsing)
            : $group;
    }

    /*
    |--------------------------------------------------------------------------
    | Variants
    |--------------------------------------------------------------------------
    */

    public static function active(
        string $field = 'is_active',
        ?string $label = 'Active',
    ): Group {

        return self::make(
            field: $field,
            label: $label,
            titleUsing: fn($state) => $state ? __('Active') : __('Not Active'),
        );
    }

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
    |--------------------------------------------------------------------------
    | Gender Variant
    |--------------------------------------------------------------------------
    */

    public static function gender(
        string $field = 'gender',
        ?string $label = 'Gender',
    ): Group {

        return self::make(
            field: $field,
            label: $label,
            titleUsing: fn($record) => $record?->getGender()?->label() ?? __('Unknown'),
        );
    }
}
