<?php

namespace Nexus\Filament\Components\Tables\Groups;

use Filament\Tables\Grouping\Group;

class TenantTypeGroup
{
    /*
    |--------------------------------------------------------------------------
    | Factory Method
    |--------------------------------------------------------------------------
    */
    public static function make(
        string $name,
        ?string $label = null,
    ): Group {
        return Group::make($name)
            ->label(__($label))
            ->getKeyFromRecordUsing(fn($record) => $record->getType()->label());
    }
}
