<?php

namespace App\Nexus\Role\Dtos;

class CreateRoleDto
{
    public function __construct(
        public readonly string $name,
        public readonly string $panel,
        public readonly string $guardName = 'web',
        public readonly ?string $tenantType = null,
        public readonly ?int $tenantId = null,
        public ?array $tenancy = null,
    ) {}

    /*
    |--------------------------------------------------------------------------
    | Export — To Array
    |--------------------------------------------------------------------------
    */

    public function toArray(): array
    {
        return array_filter([
            'name'        => $this->name,
            'panel'       => $this->panel,
            'guard_name'  => $this->guardName,
            'tenant_type' => $this->tenantType,
            'tenant_id'   => $this->tenantId,
            ...($this->tenancy ?? []),
        ], fn($value) => ! is_null($value));
    }
}
