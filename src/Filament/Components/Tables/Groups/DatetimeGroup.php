<?php

namespace Nexus\Filament\Components\Tables\Groups;

use Filament\Tables\Grouping\Group;

class DatetimeGroup
{
    /*
    |--------------------------------------------------------------------------
    | Base Builder
    |--------------------------------------------------------------------------
    */

    public static function make(
        string $field,
        ?string $label = null,
        bool $date = true,
    ): Group {

        return Group::make($field)
            ->when($date,  fn(Group $group) => $group->date())
            ->when($label, fn(Group $group) => $group->label(__($label)));
    }



    /*
    |-------------------------
    | Created At
    |-------------------------
    */

    public static function createdAt(
        string $field = 'created_at',
        ?string $label = 'Created at',
    ): Group {

        return self::make(
            field: $field,
            label: $label,
        );
    }

    /*
    |-------------------------
    | Updated At
    |-------------------------
    */

    public static function updatedAt(
        string $field = 'updated_at',
        ?string $label = 'Updated at',
    ): Group {

        return self::make(
            field: $field,
            label: $label,
        );
    }
}
