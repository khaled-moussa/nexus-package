<?php

declare(strict_types=1);

namespace Nexus\Filament\Resources\Roles;

use Nexus\Domain\Role\Models\Role;
use Nexus\Domain\Panel\Enums\PanelTypeEnum;
use Nexus\Filament\Resources\Roles\Schemas\RoleForm;
use Nexus\Filament\Resources\Roles\Tables\RolesTable;
use Nexus\Filament\Resources\Roles\Pages\CreateRole;
use Nexus\Filament\Resources\Roles\Pages\EditRole;
use Nexus\Filament\Resources\Roles\Pages\ListRoles;
use Nexus\Filament\Resources\Roles\Pages\ViewRole;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use BezhanSalleh\FilamentShield\Support\Utils;
use BezhanSalleh\FilamentShield\Traits\HasShieldFormComponents;
use BezhanSalleh\PluginEssentials\Concerns\Resource as Essentials;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Filament\Support\Icons\Heroicon;
use Illuminate\Database\Eloquent\Builder;
use BackedEnum;

class RoleResource extends Resource
{
    use Essentials\BelongsToParent;
    use HasShieldFormComponents;

    /* 
    |-------------------------------
    | Resource Configuration
    |-------------------------------
    */

    protected static string $resourceName = 'Role';

    protected static ?string $model = Role::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedShieldCheck;

    protected static ?int $navigationSort = 5;

    protected static ?string $recordTitleAttribute = 'name';

    /* 
    |-------------------------------
    | Navigation Labels
    |-------------------------------
    */

    public static function getNavigationLabel(): string
    {
        return __('Roles');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Roles');
    }

    public static function getModelLabel(): string
    {
        return __('Role');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('System');
    }

    /* 
    |-------------------------------
    | Eloquent Query 
    |-------------------------------
    */

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->whereRolesExcluded(PanelTypeEnum::options())
            ->whereTenantNull();
    }

    /* 
    |-------------------------------
    | Form & Infolist & Table
    |-------------------------------
    */

    public static function form(Schema $schema): Schema
    {
        return RoleForm::configure($schema, static::class);
    }

    public static function table(Table $table): Table
    {
        return RolesTable::configure($table);
    }

    /* 
    |-------------------------------
    | Pages
    |-------------------------------
    */

    public static function getPages(): array
    {
        return [
            'index'  => ListRoles::route('/'),
            'create' => CreateRole::route('/create'),
            'view'   => ViewRole::route('/{record}'),
            'edit'   => EditRole::route('/{record}/edit'),
        ];
    }

    /* 
    |-------------------------------
    | Methods
    |-------------------------------
    */

    public static function getCluster(): ?string
    {
        return Utils::getResourceCluster();
    }

    public static function getEssentialsPlugin(): ?FilamentShieldPlugin
    {
        return FilamentShieldPlugin::get();
    }
}
