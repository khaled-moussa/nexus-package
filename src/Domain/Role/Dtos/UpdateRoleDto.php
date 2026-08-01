<?php

namespace App\Nexus\Role\Dtos;

class UpdateRoleDto
{
    public function __construct(
        public string $name,
        public string $panel,
        public ?array $tenancy = null,
    ) {}

    /*
    |-------------------------------
    | Export — To Array
    |-------------------------------
    */

    public function toArray(): array
    {
        return array_filter([
            'name'        => $this->name,
            'panel'       => $this->panel,
            ...($this->tenancy ?? []),
        ], fn($value) => ! is_null($value));
    }
}
