<?php

namespace Nexus\Domain\Request\Listeners;

use Nexus\Domain\Notification\Actions\SendNotificationAction;
use Nexus\Domain\Request\Events\RequestCreated;
use Nexus\Domain\User\Actions\GetUsersAction;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyAdminsOfRequestCreated implements ShouldQueue
{
    use InteractsWithQueue;

    /*
    |--------------------------------------------------------------------------
    | Queue Configuration
    |--------------------------------------------------------------------------
    */

    public int $tries = 3;
    public int $backoff = 5;

    /*
    |--------------------------------------------------------------------------
    | Construct
    |--------------------------------------------------------------------------
    */

    public function __construct(
        private readonly SendNotificationAction $notify,
        private readonly GetUsersAction $users,
    ) {}

    /*
    |--------------------------------------------------------------------------
    | Handle Event
    |--------------------------------------------------------------------------
    */

    public function handle(RequestCreated $event): void
    {
        $request = $event->request;

        // Notify admins
        $this->notify->info(
            title: __('New Request Received'),
            recipients: $this->users->admins(),
            description: "Request #{$request->getId()} needs review.",
            url: route('filament.admin.resources.organization-requests.view', [
                'record' => $request?->getId()
            ]),
        );
    }
}
