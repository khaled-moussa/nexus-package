<?php

declare(strict_types=1);

namespace App\Filament\Panels\Admin\Resources\Roles;

use Nexus\Domain\Role\Models\Role;
use App\Filament\Panels\Admin\Resources\Roles\Pages\CreateRole;
use App\Filament\Panels\Admin\Resources\Roles\Pages\EditRole;
use App\Filament\Panels\Admin\Resources\Roles\Pages\ListRoles;
use App\Filament\Panels\Admin\Resources\Roles\Pages\ViewRole;
use App\Filament\Panels\Admin\Resources\Roles\Schemas\RoleForm;
use App\Filament\Panels\Admin\Resources\Roles\Tables\RolesTable;
use BezhanSalleh\FilamentShield\Support\Utils;
use BezhanSalleh\FilamentShield\Traits\HasShieldFormComponents;
use BezhanSalleh\PluginEssentials\Concerns\Resource as Essentials;
use Filament\Panel;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use BackedEnum;

class RoleResource extends Resource
{
    use Essentials\BelongsToParent;
    use Essentials\BelongsToTenant;
    use Essentials\HasGlobalSearch;
    use Essentials\HasLabels;
    use Essentials\HasNavigation;
    use HasShieldFormComponents;

    /*
    |--------------------------------------------------------------------------
    | Core Configuration
    |--------------------------------------------------------------------------
    */

    protected static ?string $model = Role::class;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?int $navigationSort = 6;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedShieldCheck;

    public static function getSlug(?Panel $panel = null): string
    {
        return Utils::getResourceSlug();
    }

    public static function getCluster(): ?string
    {
        return Utils::getResourceCluster();
    }

    /*
    |--------------------------------------------------------------------------
    | Navigation
    |--------------------------------------------------------------------------
    */

    public static function getNavigationLabel(): string
    {
        return __('Roles');
    }

    public static function getModelLabel(): string
    {
        return __('Role');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Roles');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('System');
    }

    /*
    |--------------------------------------------------------------------------
    | Form & Table
    |--------------------------------------------------------------------------
    */

    public static function form(Schema $schema): Schema
    {
        return RoleForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RolesTable::configure($table);
    }

    /*
    |--------------------------------------------------------------------------
    | Relations
    |--------------------------------------------------------------------------
    */

    public static function getRelations(): array
    {
        return [];
    }

    /*
    |--------------------------------------------------------------------------
    | Pages
    |--------------------------------------------------------------------------
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
}
