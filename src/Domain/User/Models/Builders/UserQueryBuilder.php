<?php

namespace Nexus\Domain\User\Models\Builders;

use Nexus\Domain\Panel\Enums\PanelTypeEnum;
use Nexus\Domain\Tenant\Enums\TenantTypeEnum;
use Nexus\Domain\User\Enums\SocialProviderEnum;
use Illuminate\Database\Eloquent\Builder;

class UserQueryBuilder extends Builder
{
    /*
    |--------------------------------------------------------------------------
    | Key Identifiers
    |--------------------------------------------------------------------------
    */

    public function whereId(int $id): static
    {
        return $this->where('id', $id);
    }

    public function whereUuid(string $uuid): static
    {
        return $this->where('uuid', $uuid);
    }

    /*
    |--------------------------------------------------------------------------
    | Contact Filters
    |--------------------------------------------------------------------------
    */

    public function whereEmail(string $email): static
    {
        return $this->where('email', $email);
    }

    public function wherePhone(string $phone): static
    {
        return $this->where('phone', $phone);
    }

    public function whereNotUser(int $userId)
    {
        return $this->whereKeyNot($userId);
    }

    /*
    |--------------------------------------------------------------------------
    | Panel Filters
    |--------------------------------------------------------------------------
    */

    public function wherePanel(PanelTypeEnum|string $panel): static
    {
        return $this->where('panel', $panel instanceof PanelTypeEnum ? $panel->value : $panel);
    }

    /*
    |--------------------------------------------------------------------------
    | Relations
    |--------------------------------------------------------------------------
    */

    public function whereTenantType(TenantTypeEnum|string $type): static
    {
        return $this->whereHas('tenant', fn(Builder $query) => $query->whereType($type));
    }

    /*
    |--------------------------------------------------------------------------
    | Panel Scopes
    |--------------------------------------------------------------------------
    */

    public function admin(): static
    {
        return $this->wherePanel(PanelTypeEnum::ADMIN);
    }

    public function organization(): static
    {
        return $this->whereHas('tenant')->wherePanel(PanelTypeEnum::ORGANIZATION);
    }

    public function workshop(): static
    {
        return $this->whereHas('tenant')->wherePanel(PanelTypeEnum::WORKSHOP);
    }

    /*
    |--------------------------------------------------------------------------
    | Status Filters
    |--------------------------------------------------------------------------
    */

    public function active(): static
    {
        return $this->where('is_active', true);
    }

    public function inactive(): static
    {
        return $this->where('is_active', false);
    }

    public function verified(): static
    {
        return $this->whereNotNull('email_verified_at');
    }

    /*
    |--------------------------------------------------------------------------
    | Date Scopes
    |--------------------------------------------------------------------------
    */

    public function latestFirst(): static
    {
        return $this->orderByDesc('created_at');
    }

    public function oldestFirst(): static
    {
        return $this->orderBy('created_at');
    }

    /*
    |--------------------------------------------------------------------------
    | Relationship Scopes
    |--------------------------------------------------------------------------
    */

    public function forOrganization(): static
    {
        return $this->organization()
            ->withAggregate('tenant', 'name');
    }

    public function forWorkshop(): static
    {
        return $this->workshop()
            ->withAggregate('tenant', 'name');
    }

    public function forSocialAccounts(): static
    {
        return $this->withExists(
            collect(SocialProviderEnum::cases())
                ->mapWithKeys(fn(SocialProviderEnum $provider) => [
                    "socialAccounts as has_{$provider->value}_account" => fn($query) => $query->where('provider', $provider->value),
                ])->all()
        );
    }
}
