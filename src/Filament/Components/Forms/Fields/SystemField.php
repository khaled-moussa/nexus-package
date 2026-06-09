<?php

namespace Nexus\Filament\Components\Forms\Fields;

use Nexus\Support\Enums\ThemeEnum;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Tapp\FilamentTimezoneField\Forms\Components\TimezoneSelect;

class SystemField
{
    /*
    |--------------------------------------------------------------------------
    | Theme
    |--------------------------------------------------------------------------
    */

    public static function theme(
        string $name = 'theme',
        ?string $label = 'Theme',
        bool $fullWidth = true,
    ): Select {

        return SelectField::make(
            name: $name,
            label: $label,
            options: ThemeEnum::options(),
        )
            ->prefixIcon('heroicon-o-sun')
            ->when($fullWidth, fn(Select $field) => $field->columnSpanFull());
    }

    /*
    |--------------------------------------------------------------------------
    | Timezone
    |--------------------------------------------------------------------------
    */

    public static function timezone(
        string $name = 'timezone',
        ?string $label = 'Timezone',
        bool $fullWidth = true,
        bool $searchable = true,
        bool $native = false,
    ): TimezoneSelect {

        return TimezoneSelect::make($name)
            ->label($label ? __($label) : null)
            ->when($searchable, fn(TimezoneSelect $field) => $field->searchable())
            ->when($native, fn(TimezoneSelect $field) => $field->native())
            ->when($fullWidth, fn(TimezoneSelect $field) => $field->columnSpanFull());
    }

    /*
    |--------------------------------------------------------------------------
    | Notification
    |--------------------------------------------------------------------------
    */

    public static function siteNotification(
        string $name = 'siteNotificationActive',
        ?string $label = 'Site Notification',
    ): Toggle {

        return ToggleField::make(
            name: $name,
            label: $label,
            helperText: 'Receive notifications inside the system (alerts, updates, and quotations).',
        );
    }

    public static function emailNotification(
        string $name = 'emailNotificationActive',
        ?string $label = 'Email Notification',
    ): Toggle {

        return ToggleField::make(
            name: $name,
            label: $label,
            helperText: 'Receive notifications via email to your inbox.',
        );
    }
}
