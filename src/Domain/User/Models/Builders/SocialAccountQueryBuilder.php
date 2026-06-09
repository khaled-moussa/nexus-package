<?php

namespace Nexus\Domain\User\Models\Builders;

use Nexus\Domain\User\Enums\SocialProviderEnum;
use Illuminate\Database\Eloquent\Builder;

class SocialAccountQueryBuilder extends Builder
{
    /*
    |--------------------------------------------------------------------------
    | Identifiers
    |--------------------------------------------------------------------------
    */

    public function whereId(int $id): self
    {
        return $this->where('id', $id);
    }

    public function whereUuid(string $uuid): self
    {
        return $this->where('uuid', $uuid);
    }

    /*
    |--------------------------------------------------------------------------
    | Provider Filters
    |--------------------------------------------------------------------------
    */

    public function whereProvider(SocialProviderEnum|string $provider): self
    {
        return $this->where('provider', $provider instanceof SocialProviderEnum ? $provider->value : $provider);
    }

    public function whereProviderId(string $providerId): self
    {
        return $this->where('provider_id', $providerId);
    }

    /*
    |--------------------------------------------------------------------------
    | Relations
    |--------------------------------------------------------------------------
    */

    public function whereUser(int $userId): self
    {
        return $this->where('user_id', $userId);
    }

    /*
    |--------------------------------------------------------------------------
    | Sorting
    |--------------------------------------------------------------------------
    */

    public function latestFirst(): self
    {
        return $this->orderByDesc('created_at');
    }

    public function oldestFirst(): self
    {
        return $this->orderBy('created_at');
    }
}
