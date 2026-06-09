<?php

namespace Nexus\Filament\Components\Tables\Columns;

use Closure;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Columns\TextColumn;

class UserColumn
{
    /*
    |--------------------------------------------------------------------------
    | Gender
    |--------------------------------------------------------------------------
    */

    public static function gender(
        string $name = 'gender',
        ?string $label = 'Gender',
    ): TextColumn {

        return TextColumn::make($name)
            ->label($label ? __($label) : null)
            ->badge()
            ->formatStateUsing(fn($state) => $state?->label())
            ->color(fn($state) => $state?->filamentColor())
            ->placeholder(__('No gender'));
    }

    /*
    |--------------------------------------------------------------------------
    | Name / Identity
    |--------------------------------------------------------------------------
    */

    public static function name(
        string $name = 'full_name',
        ?string $label = 'Full name',
        ?Closure $description = null,
    ): TextColumn {

        return TextColumn::make($name)
            ->label($label ? __($label) : null)
            ->description($description)
            ->weight(FontWeight::Bold)
            ->limit(40)
            ->tooltip(fn($state) => $state)
            ->searchable();
    }

    public static function creator(
        string $name = 'full_name',
        ?string $label = 'Full name',
        ?Closure $description = null,
    ): TextColumn {

        return TextColumn::make($name)
            ->label($label ? __($label) : null)
            ->description($description)
            ->weight(FontWeight::Bold)
            ->limit(40)
            ->tooltip(fn($state) => $state)
            ->searchable(true,  fn($query, $search) => $query->orWhereRelation('creator', 'full_name', 'like', "%{$search}%"));
    }
}
