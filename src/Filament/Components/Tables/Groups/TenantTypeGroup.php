<?php

namespace Nexus\Filament\Components\Tables\Groups;

use Filament\Tables\Grouping\Group;

class TenantTypeGroup
{
    /*
    |--------------------------------------------------------------------------
    | Tenant Group
    |--------------------------------------------------------------------------
    */

    public static function make(
        string $name,
        ?string $label = null,
    ): Group {

        return Group::make($name)
            ->getKeyFromRecordUsing(fn($record) => $record->getType()->label())
            ->when($label, fn(Group $group) => $group->label(__($label)));
    }
}
