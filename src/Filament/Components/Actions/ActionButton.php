<?php

namespace Nexus\Filament\Components\Actions;

use Closure;
use Filament\Actions\Action;
use Filament\Support\Enums\Size;
use Filament\Support\Icons\Heroicon;

class ActionButton
{
    public static function make(
        string $name,
        Closure $action,
        ?string $label = null,
        string|array|null $color = null,
        bool $hiddenLabel = false,
        Closure|bool $hidden = false,
        Size $size = Size::Small,
        ?Heroicon $icon = null,
        ?string $successTitle = null,
        bool $isButton = true,
        bool $requiresConfirmation = false,
    ): Action {
        return Action::make($name)
            ->label($label ? __($label) : null)
            ->hiddenLabel($hiddenLabel)
            ->hidden($hidden)
            ->size($size)
            ->action($action)
            ->when($isButton, fn($a) => $a->button())
            ->when($icon, fn($a) => $a->icon($icon))
            ->when($color, fn($a) => $a->color($color))
            ->when($requiresConfirmation, fn($a) => $a->requiresConfirmation())
            ->when($successTitle, fn($a) => $a->successNotificationTitle($successTitle));
    }

    /*
    |--------------------------------------------------------------------------
    | Size Variants
    |--------------------------------------------------------------------------
    */

    public static function sm(
        string $name,
        Closure $action,
        ?string $label = null,
        ?Heroicon $icon = null,
        ?string $successTitle = null,
        bool $requiresConfirmation = false,
        Closure|bool $hidden = false,
    ): Action {
        return self::make(
            name: $name,
            action: $action,
            label: $label,
            icon: $icon,
            size: Size::Small,
            successTitle: $successTitle,
            requiresConfirmation: $requiresConfirmation,
            hidden: $hidden,
        );
    }

    public static function md(
        string $name,
        Closure $action,
        ?string $label = null,
        ?Heroicon $icon = null,
        ?string $successTitle = null,
        bool $requiresConfirmation = false,
        bool $hidden = false,
    ): Action {
        return self::make(
            name: $name,
            action: $action,
            label: $label,
            icon: $icon,
            size: Size::Medium,
            successTitle: $successTitle,
            requiresConfirmation: $requiresConfirmation,
            hidden: $hidden,
        );
    }

    public static function lg(
        string $name,
        Closure $action,
        ?string $label = null,
        ?Heroicon $icon = null,
        ?string $successTitle = null,
        bool $requiresConfirmation = false,
        bool $hidden = false,
    ): Action {
        return self::make(
            name: $name,
            action: $action,
            label: $label,
            icon: $icon,
            size: Size::Large,
            successTitle: $successTitle,
            requiresConfirmation: $requiresConfirmation,
            hidden: $hidden,
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Prebuilt Actions
    |--------------------------------------------------------------------------
    */

    public static function danger(
        string $name,
        Closure $action,
        string $label,
        ?Heroicon $icon = null,
        bool $requiresConfirmation = false,
        bool $hidden = false,
    ): Action {
        return self::make(
            name: $name,
            action: $action,
            label: $label,
            color: 'danger',
            icon: $icon,
            requiresConfirmation: $requiresConfirmation,
            hidden: $hidden,
        );
    }

    public static function success(
        string $name,
        Closure $action,
        string $label,
        ?Heroicon $icon = null,
        bool $requiresConfirmation = false,
        bool $hidden = false,
    ): Action {
        return self::make(
            name: $name,
            action: $action,
            label: $label,
            color: 'success',
            icon: $icon,
            requiresConfirmation: $requiresConfirmation,
            hidden: $hidden,
        );
    }

    public static function link(
        string $name,
        string $label,
        Closure|string $url,
        ?Heroicon $icon = null,
        bool $openInNewTab = false,
        bool $hidden = false,
    ): Action {
        return Action::make($name)
            ->label(__($label))
            ->link()
            ->url($url, shouldOpenInNewTab: $openInNewTab)
            ->hidden($hidden)
            ->when($icon, fn($a) => $a->icon($icon));
    }
}
