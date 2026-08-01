<?php


namespace App\Nexus\Permission\Actions;

use Illuminate\Support\Collection;

class ExtractPermissionsAction
{
    public function execute(array $data, array $excludedKeys = []): Collection
    {
        return collect($data)
            ->reject(fn($value, $key) => in_array($key, $excludedKeys))
            ->filter(fn($value) => is_array($value) && count($value))
            ->flatMap(fn($permissions) => $permissions)
            ->unique()
            ->values();
    }
}
