<?php

namespace Nexus\Domain\Notification\Actions;

use Filament\Actions\Action;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Nexus\Filament\Components\Notifications\NotificationDatabase;

class SendNotificationAction
{
    /*
    |--------------------------------------------------------------------------
    | Send Success Notification
    |--------------------------------------------------------------------------
    */

    public function success(
        string $title,
        Model|Collection|array|null $recipients,
        ?string $description = null,
        ?string $url = null,
        array $actions = [],
        bool $broadcast = true,
    ): void {
        $this->send(
            type: 'success',
            title: $title,
            recipients: $recipients,
            description: $description,
            url: $url,
            actions: $actions,
            broadcast: $broadcast,
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Send Error Notification
    |--------------------------------------------------------------------------
    */

    public function error(
        string $title,
        Model|Collection|array|null $recipients,
        ?string $description = null,
        ?string $url = null,
        array $actions = [],
        bool $broadcast = true,
    ): void {
        $this->send(
            type: 'error',
            title: $title,
            recipients: $recipients,
            description: $description,
            url: $url,
            actions: $actions,
            broadcast: $broadcast,
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Send Warning Notification
    |--------------------------------------------------------------------------
    */

    public function warning(
        string $title,
        Model|Collection|array|null $recipients,
        ?string $description = null,
        ?string $url = null,
        array $actions = [],
        bool $broadcast = true,
    ): void {
        $this->send(
            type: 'warning',
            title: $title,
            recipients: $recipients,
            description: $description,
            url: $url,
            actions: $actions,
            broadcast: $broadcast,
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Send Info Notification
    |--------------------------------------------------------------------------
    */

    public function info(
        string $title,
        Model|Collection|array|null $recipients,
        ?string $description = null,
        ?string $url = null,
        array $actions = [],
        bool $broadcast = true,
    ): void {
        $this->send(
            type: 'info',
            title: $title,
            recipients: $recipients,
            description: $description,
            url: $url,
            actions: $actions,
            broadcast: $broadcast,
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Core Send
    |--------------------------------------------------------------------------
    */

    private function send(
        string $type,
        string $title,
        Model|Collection|array|null $recipients,
        ?string $description = null,
        ?string $url = null,
        array $actions = [],
        bool $broadcast = true,
    ): void {
        /*
        |--------------------------------------------------------------------------
        | Guard — No Recipients
        |--------------------------------------------------------------------------
        */

        if (! $this->hasRecipients($recipients)) {
            Log::info('SendNotificationAction|Skipped — no valid recipients.', [
                'title'            => $title,
                'type'             => $type,
                'description'      => $description,
                'recipients_type'  => get_class($recipients) ?? gettype($recipients),
                'recipients_count' => $recipients instanceof Collection
                    ? $recipients->count()
                    : (is_array($recipients) ? count($recipients) : 'N/A'),
            ]);

            return;
        }

        /*
        |--------------------------------------------------------------------------
        | Dispatch After Commit
        |--------------------------------------------------------------------------
        */

        DB::afterCommit(function () use ($type, $title, $recipients, $description, $url, $actions, $broadcast) {

            // Auto-inject view action if URL provided and no custom actions
            if ($url && empty($actions)) {
                $actions[] = Action::make('view')
                    ->button()
                    ->url($url)
                    ->markAsRead();
            }

            try {
                match ($type) {
                    'success' => NotificationDatabase::success(
                        title: $title,
                        recipients: $recipients,
                        description: $description,
                        actions: $actions,
                        broadcast: $broadcast,
                    ),
                    'error' => NotificationDatabase::error(
                        title: $title,
                        recipients: $recipients,
                        description: $description,
                        actions: $actions,
                        broadcast: $broadcast,
                    ),
                    'warning' => NotificationDatabase::warning(
                        title: $title,
                        recipients: $recipients,
                        description: $description,
                        actions: $actions,
                        broadcast: $broadcast,
                    ),
                    default => NotificationDatabase::info(
                        title: $title,
                        recipients: $recipients,
                        description: $description,
                        actions: $actions,
                        broadcast: $broadcast,
                    ),
                };
            } catch (\Throwable $e) {
                Log::error('SendNotificationAction|Failed to send notification.', [
                    'title' => $title,
                    'type'  => $type,
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString(),
                ]);
            }
        });
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    private function hasRecipients(Model|Collection|array|null $recipients): bool
    {
        return match (true) {
            is_null($recipients)              => false,
            $recipients instanceof Model      => true,
            $recipients instanceof Collection => $recipients->isNotEmpty(),
            is_array($recipients)             => ! empty($recipients),
            default                           => false,
        };
    }
}