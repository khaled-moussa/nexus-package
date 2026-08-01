<?php

namespace App\Filament\Panels\Admin\Resources\Roles\Schemas;

use App\Filament\Panels\Admin\Resources\Roles\RoleResource;
use Filament\Schemas\Components\Component;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Nexus\Filament\Components\Forms\Fields\NameField;
use Nexus\Filament\Components\Infolists\Sections\CustomSection;

class RoleForm
{
    /*
    |--------------------------------------------------------------------------
    | Configure
    |--------------------------------------------------------------------------
    */

    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            self::roleInformationSection(),
            self::permissionsDetailsSection(),
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Role Information
    |--------------------------------------------------------------------------
    */

    private static function roleInformationSection(): Section
    {
        return CustomSection::make(__('Role Information'))
            ->description(__('Define the role name, authentication guard, and tenancy settings.'))
            ->schema([
                NameField::make(
                    name: 'name',
                    label: 'Rolte Name',
                    unique: true,
                    uniqueTable: 'roles'
                ),
            ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Permissions Details
    |--------------------------------------------------------------------------
    */

    private static function permissionsDetailsSection(): Section
    {
        return CustomSection::make(__('Permissions'))
            ->description(__('Assign the permissions that belong to this role.'))
            ->columnSpanFull()
            ->schema([
                static::getSelectAllFormComponent(),
                static::getShieldFormComponents(),
            ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Shield Components
    |--------------------------------------------------------------------------
    */

    private static function getSelectAllFormComponent(): Component
    {
        return RoleResource::getSelectAllFormComponent();
    }

    private static function getShieldFormComponents(): Component
    {
        return RoleResource::getShieldFormComponents();
    }
}
