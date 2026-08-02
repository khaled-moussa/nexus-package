<?php

namespace Nexus\Filament\Resources\Roles\Tables;

use Nexus\Filament\Components\Actions\GroupedActionsButton;
use Nexus\Filament\Components\Tables\Columns\CountColumn;
use Nexus\Filament\Components\Tables\Columns\DatetimeColumn;
use Nexus\Filament\Components\Tables\Columns\NameColumn;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Table;

class RolesTable
{
    /*
    |--------------------------------------------------------------------------
    | Table Configuration
    |--------------------------------------------------------------------------
    */

    public static function configure(Table $table): Table
    {
        return $table

            /*
            |--------------------------------------------------------------------------
            | Header
            |--------------------------------------------------------------------------
            */

            ->heading(__('Roles'))
            ->description(__('Manage roles and their assigned permissions.'))

            /*
            |--------------------------------------------------------------------------
            | Columns
            |--------------------------------------------------------------------------
            */

            ->columns(self::columns())

            /*
            |--------------------------------------------------------------------------
            | Options
            |--------------------------------------------------------------------------
            */

            ->deferLoading()
            ->stackedOnMobile()
            ->searchPlaceholder(__('Search by role name'))

            /*
            |--------------------------------------------------------------------------
            | Filters
            |--------------------------------------------------------------------------
            */

            ->filters(self::filters())

            /*
            |--------------------------------------------------------------------------
            | Raw Actions
            |--------------------------------------------------------------------------
            */

            ->recordActions(self::recordActions())
            ->toolbarActions(self::toolbarActions());
    }

    /*
    |--------------------------------------------------------------------------
    | Columns
    |--------------------------------------------------------------------------
    */

    private static function columns(): array
    {
        return [
            NameColumn::make(
                name: 'display_name',
                label: 'Role Name',
                searchable: true,
            ),

            CountColumn::make(
                name: 'permissions_count',
                label: 'Permissions',
                relation: 'permissions'
            ),

            DatetimeColumn::createdAt(),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Filters
    |--------------------------------------------------------------------------
    */

    private static function filters(): array
    {
        return [];
    }

    /*
    |--------------------------------------------------------------------------
    | Raw Actions
    |--------------------------------------------------------------------------
    */

    private static function recordActions()
    {
        return GroupedActionsButton::actions(canView: false);
    }

    private static function toolbarActions()
    {
        return BulkActionGroup::make([
            DeleteBulkAction::make(),
        ]);
    }
}
