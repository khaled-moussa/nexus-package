<?php

namespace Nexus\Domain\User\Dtos;

use Nexus\Domain\User\Enums\SocialProviderEnum;

class SocialAccountDto
{
    public function __construct(
        public SocialProviderEnum $provider,
        public string $label,
        public bool $linked,
    ) {}
}