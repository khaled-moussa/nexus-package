<?php


namespace Nexus\Permission\Actions;

use Nexus\Permission\Models\Permission;
use Illuminate\Support\Str;

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
