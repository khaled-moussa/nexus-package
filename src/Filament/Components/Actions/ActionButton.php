<?php

namespace Nexus\Filament\Components\Actions;

use Closure;
use Filament\Actions\Action;
use Filament\Support\Enums\Size;
use Filament\Support\Icons\Heroicon;

class ActionButton
{
    /*
    |--------------------------------------------------------------------------
    | Base Builder
    |--------------------------------------------------------------------------
    */

    public static function make(
        string $name,
        ?Closure $callback = null,
        ?string $label = null,
        ?Heroicon $icon = null,
        string|array|null $color = null,
        Size $size = Size::Small,
        bool $isButton = true,
        bool $hiddenLabel = false,
        Closure|bool $hidden = false,
        bool $requiresConfirmation = false,
        ?string $successTitle = null,
    ): Action {
        $action = Action::make($name)
            ->hidden($hidden)
            ->hiddenLabel($hiddenLabel)
            ->size($size)
            ->when($label,            fn(Action $a) => $a->label(__($label)))
            ->when($isButton,         fn(Action $a) => $a->button())
            ->when($icon,             fn(Action $a) => $a->icon($icon))
            ->when($color,            fn(Action $a) => $a->color($color))
            ->when($requiresConfirmation, fn(Action $a) => $a->requiresConfirmation())
            ->when($successTitle,     fn(Action $a) => $a->successNotificationTitle(__($successTitle)));

        if (! is_null($callback)) {
            $action->action($callback);
        }

        return $action;
    }

    /*
    |-------------------------
    | Small Size Vraiant
    |-------------------------
    */

    public static function sm(
        string $name,
        ?Closure $callback = null,
        ?string $label = null,
        ?Heroicon $icon = null,
        ?string $successTitle = null,
        bool $requiresConfirmation = false,
        Closure|bool $hidden = false,
    ): Action {
        return self::make(
            name: $name,
            callback: $callback,
            label: $label,
            icon: $icon,
            size: Size::Small,
            successTitle: $successTitle,
            requiresConfirmation: $requiresConfirmation,
            hidden: $hidden,
        );
    }

    /*
    |-------------------------
    | Medium Size Vraiant
    |-------------------------
    */

    public static function md(
        string $name,
        ?Closure $callback = null,
        ?string $label = null,
        ?Heroicon $icon = null,
        ?string $successTitle = null,
        bool $requiresConfirmation = false,
        Closure|bool $hidden = false,
    ): Action {
        return self::make(
            name: $name,
            callback: $callback,
            label: $label,
            icon: $icon,
            size: Size::Medium,
            successTitle: $successTitle,
            requiresConfirmation: $requiresConfirmation,
            hidden: $hidden,
        );
    }

    /*
    |-------------------------
    | Large Size Vraiant
    |-------------------------
    */

    public static function lg(
        string $name,
        ?Closure $callback = null,
        ?string $label = null,
        ?Heroicon $icon = null,
        ?string $successTitle = null,
        bool $requiresConfirmation = false,
        Closure|bool $hidden = false,
    ): Action {
        return self::make(
            name: $name,
            callback: $callback,
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
    | Color Variants
    |--------------------------------------------------------------------------
    */

    /*
    |-------------------------
    | Danger Color Vraiant
    |-------------------------
    */

    public static function danger(
        string $name,
        ?Closure $callback = null,
        string $label,
        ?Heroicon $icon = null,
        bool $requiresConfirmation = false,
        Closure|bool $hidden = false,
    ): Action {
        return self::make(
            name: $name,
            callback: $callback,
            label: $label,
            color: 'danger',
            icon: $icon,
            requiresConfirmation: $requiresConfirmation,
            hidden: $hidden,
        );
    }

    /*
    |-------------------------
    | Success Color Vraiant
    |-------------------------
    */

    public static function success(
        string $name,
        ?Closure $callback = null,
        string $label,
        ?Heroicon $icon = null,
        bool $requiresConfirmation = false,
        Closure|bool $hidden = false,
    ): Action {
        return self::make(
            name: $name,
            callback: $callback,
            label: $label,
            color: 'success',
            icon: $icon,
            requiresConfirmation: $requiresConfirmation,
            hidden: $hidden,
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Link Actions
    |--------------------------------------------------------------------------
    */

    public static function link(
        string $name,
        string $label,
        Closure|string $url,
        ?Heroicon $icon = null,
        bool $openInNewTab = false,
        Closure|bool $hidden = false,
    ): Action {
        return Action::make($name)
            ->hidden($hidden)
            ->link()
            ->label(__($label))
            ->url($url, shouldOpenInNewTab: $openInNewTab)
            ->when($icon, fn(Action $action) => $action->icon($icon));
    }
}
