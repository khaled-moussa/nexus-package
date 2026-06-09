<?php

namespace Nexus\Domain\Dashboard\Dtos;

use ArrayAccess;
use JsonSerializable;

class DashboardResultDto implements ArrayAccess, JsonSerializable
{
    public function __construct(
        private array $data = []
    ) {}

    /*
    |--------------------------------------------------------------------------
    | Object Access ($stats->admins)
    |--------------------------------------------------------------------------
    */

    public function __get(string $key): mixed
    {
        return $this->data[$key] ?? null;
    }

    /*
    |--------------------------------------------------------------------------
    | Array Access ($stats['admins'])
    |--------------------------------------------------------------------------
    */

    public function offsetExists($offset): bool
    {
        return isset($this->data[$offset]);
    }

    public function offsetGet($offset): mixed
    {
        return $this->__get($offset);
    }

    public function offsetSet($offset, $value): void
    {
        $this->data[$offset] = $value;
    }

    public function offsetUnset($offset): void
    {
        unset($this->data[$offset]);
    }

    /*
    |--------------------------------------------------------------------------
    | JSON Support
    |--------------------------------------------------------------------------
    */

    public function jsonSerialize(): array
    {
        return $this->data;
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    public function toArray(): array
    {
        return $this->data;
    }
}