<?php

declare(strict_types=1);

namespace App\Filament\Panels\Admin\Resources\Roles\Pages;

use App\Filament\Panels\Admin\Resources\Roles\RoleResource;
use BezhanSalleh\FilamentShield\Support\Utils;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class CreateRole extends CreateRecord
{
    /*
    |--------------------------------------------------------------------------
    | Properties
    |--------------------------------------------------------------------------
    */

    public Collection $permissions;

    protected static string $resource = RoleResource::class;

    /*
    |--------------------------------------------------------------------------
    | Data Mutation
    |--------------------------------------------------------------------------
    */

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['guard_name'] ??= 'web';

        $this->permissions = $this->extractPermissions($data);

        return $this->prepareRoleData($data);
    }

    /*
    |--------------------------------------------------------------------------
    | Lifecycle Hooks
    |--------------------------------------------------------------------------
    */

    protected function afterCreate(): void
    {
        $permissionModels = $this->permissions
            ->map(fn (string $permission) => Utils::getPermissionModel()::firstOrCreate([
                'name'       => $permission,
                'guard_name' => $this->record->guard_name ?? 'web',
            ]));

        $this->record->syncPermissions($permissionModels);
    }

    /*
    |--------------------------------------------------------------------------
    | Permission Handling
    |--------------------------------------------------------------------------
    */

    private function extractPermissions(array $data): Collection
    {
        return collect($data)
            ->except([
                'name',
                'guard_name',
                'select_all',
                Utils::getTenantModelForeignKey(),
            ])
            ->flatten()
            ->filter()
            ->unique()
            ->values();
    }

    /*
    |--------------------------------------------------------------------------
    | Role Data Preparation
    |--------------------------------------------------------------------------
    */

    private function prepareRoleData(array $data): array
    {
        $fields = ['name', 'guard_name'];

        if (
            Utils::isTenancyEnabled()
            && filled($data[Utils::getTenantModelForeignKey()] ?? null)
        ) {
            $fields[] = Utils::getTenantModelForeignKey();
        }

        return Arr::only($data, $fields);
    }
}