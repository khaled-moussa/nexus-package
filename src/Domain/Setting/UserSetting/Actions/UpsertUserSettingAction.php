<?php

namespace Nexus\Domain\Setting\UserSetting\Actions;

use Nexus\Domain\Setting\UserSetting\Dtos\UserSettingDto;
use Nexus\Domain\Setting\UserSetting\Models\UserSetting;

class UpsertUserSettingAction
{
    public function execute(UserSettingDto $dto): UserSetting
    {
        return UserSetting::updateOrCreate(
            ['user_id' => $dto->userId],
            $dto->toArray()
        );
    }
}
