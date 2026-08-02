<?php


namespace Nexus\Domain\Permission\Actions;

use Illuminate\Support\Str;
use Nexus\Domain\Permission\Models\Permission;

class GetPermissionsFilteredByPanelAction
{
    public function execute(array $entity, string $panel): array
    {
        $resourceClass = $entity['resourceFqcn'];
        $resourceName  = class_basename($resourceClass);
        $resolvedResourceName = Str::before($resourceName, 'Resource');

        return Permission::query()
            ->where('panel', $panel)
            ->where('name', 'like', "%:{$resolvedResourceName}:{$panel}")
            ->get()
            ->mapWithKeys(function ($permission) {
                $action = Str::before($permission->name, ':');

                return [
                    $permission->name => Str::headline($action),
                ];
            })
            ->toArray();
    }
}
