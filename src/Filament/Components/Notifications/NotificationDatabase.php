<?php

namespace Nexus\Filament\Components\Notifications;

use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class NotificationDatabase
{
    /*
    |--------------------------------------------------------------------------
    | Main Builder
    |--------------------------------------------------------------------------
    */

    public static function make(
        string $title,
        Model|Collection|EloquentCollection|array $recipients,
        ?string $description = null,
        string $status = 'success',
        int $duration = 5000,
        bool $persistent = false,
        array $actions = [],
        bool $broadcast = true,
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
        | Send to DB + Broadcast
        |--------------------------------------------------------------------------
        */

        foreach (self::normalizeRecipients($recipients) as $recipient) {
            $notification->sendToDatabase($recipient, isEventDispatched: $broadcast);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Shortcuts
    |--------------------------------------------------------------------------
    */

    public static function success(
        string $title,
        Model|Collection|EloquentCollection|array $recipients,
        ?string $description = null,
        array $actions = [],
        bool $broadcast = true,
    ): void {
        self::make($title, $recipients, $description, 'success', actions: $actions, broadcast: $broadcast);
    }

    public static function error(
        string $title,
        Model|Collection|EloquentCollection|array $recipients,
        ?string $description = null,
        array $actions = [],
        bool $broadcast = true,
    ): void {
        self::make($title, $recipients, $description, 'danger', actions: $actions, broadcast: $broadcast);
    }

    public static function warning(
        string $title,
        Model|Collection|EloquentCollection|array $recipients,
        ?string $description = null,
        array $actions = [],
        bool $broadcast = true,
    ): void {
        self::make($title, $recipients, $description, 'warning', actions: $actions, broadcast: $broadcast);
    }

    public static function info(
        string $title,
        Model|Collection|EloquentCollection|array $recipients,
        ?string $description = null,
        array $actions = [],
        bool $broadcast = true,
    ): void {
        self::make($title, $recipients, $description, 'info', actions: $actions, broadcast: $broadcast);
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    private static function normalizeRecipients(Model|Collection|EloquentCollection|array $recipients): array
    {
        return match (true) {
            $recipients instanceof Model              => [$recipients],
            $recipients instanceof Collection,
            $recipients instanceof EloquentCollection => $recipients->all(),
            is_array($recipients)                     => $recipients,
        };
    }

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
