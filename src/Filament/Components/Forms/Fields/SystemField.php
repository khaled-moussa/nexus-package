<?php

namespace Nexus\Filament\Components\Forms\Fields;

use App\Support\Enums\ThemeEnum;
use Tapp\FilamentTimezoneField\Forms\Components\TimezoneSelect;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Support\Icons\Heroicon;

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
            prefixIcon: Heroicon::OutlinedSun,
            fullWidth: $fullWidth,
        );
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
            ->when($label,      fn(TimezoneSelect $field) => $field->label(__($label)))
            ->when($searchable, fn(TimezoneSelect $field) => $field->searchable())
            ->when($native,     fn(TimezoneSelect $field) => $field->native())
            ->when($fullWidth,  fn(TimezoneSelect $field) => $field->columnSpanFull());
    }

    /*
    |--------------------------------------------------------------------------
    | Notification Toggle
    |--------------------------------------------------------------------------
    */

    public static function siteNotification(
        string $name = 'siteNotificationActive',
        ?string $label = 'Site Notification'
    ): Toggle {

        return ToggleField::make(
            name: $name,
            label: $label,
            helperText: 'Receive notifications inside the system (alerts, updates, and quotations).',
        );
    }

    public static function emailNotification(
        string $name = 'emailNotificationActive',
        ?string $label = 'Email Notification'
    ): Toggle {

        return ToggleField::make(
            name: $name,
            label: $label,
            helperText: 'Receive notifications via email to your inbox.',
        );
    }
}
