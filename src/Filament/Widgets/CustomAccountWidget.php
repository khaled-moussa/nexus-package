<?php

namespace Nexus\Filament\Widgets;

use Filament\Widgets\AccountWidget;

class CustomAccountWidget extends AccountWidget
{
    protected int | string | array $columnSpan = 'full';
}
