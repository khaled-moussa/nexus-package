<?php

namespace Nexus\Domain\Setting\UserSetting\Dtos;

use Nexus\Support\Enums\ThemeEnum;

class UserSettingDto
{
    public function __construct(
        public readonly int $userId,
        public readonly string $timezone,
        public readonly bool $siteNotificationActive,
        public readonly bool $emailNotificationActive,
    ) {}

    public function toArray(): array
    {
        return [
            'user_id'  => $this->userId,
            'timezone' => $this->timezone,
            'site_notification_active' => $this->siteNotificationActive,
            'email_notification_active' => $this->emailNotificationActive,
        ];
    }
}