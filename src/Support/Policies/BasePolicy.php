<?php

declare(strict_types=1);

namespace Nexus\Support\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Auth\Access\HandlesAuthorization;
use Nexus\Domain\Panel\Enums\PanelTypeEnum;

class BasePolicy
{
    use HandlesAuthorization;

    protected function permissionPrefix(): string
    {
        return filament()->getCurrentPanel()?->getId();
    }

    protected function can(AuthUser $authUser, string $action): bool
    {
        if (PanelTypeEnum::from($this->permissionPrefix()) !== PanelTypeEnum::ADMIN) {
            return true;
        }

        return $authUser->can($action . ':' . $this->permissionPrefix());
    }
}
