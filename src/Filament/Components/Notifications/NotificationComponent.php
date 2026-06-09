<?php

namespace Nexus\Filament\Components\Notifications;

use Filament\Notifications\Notification;

class NotificationComponent
{
    /*
    |--------------------------------------------------------------------------
    | Main Builder
    |--------------------------------------------------------------------------
    */

    public static function make(
        string $title,
        ?string $description = null,
        string $status = 'success',
        int $duration = 5000,
        bool $persistent = false,
        array $actions = [],
    ): void {
        $notification = Notification::make()
            ->title($title)
            ->duration($duration);

        /*
        |--------------------------------------------------------------------------
        | Description
        |--------------------------------------------------------------------------
        */

        if (filled($description)) {
            $notification->body($description);
        }

        /*
        |--------------------------------------------------------------------------
        | Status
        |--------------------------------------------------------------------------
        */

        self::applyStatus($notification, $status);

        /*
        |--------------------------------------------------------------------------
        | Persistent
        |--------------------------------------------------------------------------
        */

        if ($persistent) {
            $notification->persistent();
        }

        /*
        |--------------------------------------------------------------------------
        | Actions
        |--------------------------------------------------------------------------
        */

        if (filled($actions)) {
            $notification->actions($actions);
        }

        /*
        |--------------------------------------------------------------------------
        | Send Flash
        |--------------------------------------------------------------------------
        */

        $notification->send();
    }

    /*
    |--------------------------------------------------------------------------
    | Shortcuts
    |--------------------------------------------------------------------------
    */

    public static function success(string $title, ?string $description = null): void
    {
        self::make($title, $description, 'success');
    }

    public static function error(string $title, ?string $description = null): void
    {
        self::make($title, $description, 'danger');
    }

    public static function warning(string $title, ?string $description = null): void
    {
        self::make($title, $description, 'warning');
    }

    public static function info(string $title, ?string $description = null): void
    {
        self::make($title, $description, 'info');
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    private static function applyStatus(Notification $notification, string $status): void
    {
        match ($status) {
            'success' => $notification->success(),
            'danger'  => $notification->danger(),
            'warning' => $notification->warning(),
            'info'    => $notification->info(),
            default   => $notification->success(),
        };
    }
}