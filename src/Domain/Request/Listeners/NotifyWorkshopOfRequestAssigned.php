<?php

namespace Nexus\Domain\Request\Listeners;

use Nexus\Domain\Notification\Actions\SendNotificationAction;
use Nexus\Domain\Request\Events\RequestAssignedToWorkshop;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyWorkshopOfRequestAssigned implements ShouldQueue
{
    use InteractsWithQueue;

    /*
    |--------------------------------------------------------------------------
    | Construct
    |--------------------------------------------------------------------------
    */

    public function __construct(
        private readonly SendNotificationAction $notify,
    ) {}

    /*
    |--------------------------------------------------------------------------
    | Handle Event
    |--------------------------------------------------------------------------
    */

    public function handle(RequestAssignedToWorkshop $event): void
    {
        $request = $event->requestWorkshop;
        $owner = $event->getOwner();
        $tenant = $event->getTenant();

        // Notify admins
        $this->notify->info(
            title: __('New Request Assigned'),
            recipients: $owner,

            description: __('A new request #:uuid has been assigned to your workshop and is ready for review.', [
                'uuid' => $request->getUuid(),
            ]),

            url: route('filament.workshop.resources.requests.view', [
                'record' => $request->getId(),
                'tenant' => $tenant->getUuid(),
            ]),
        );
    }
}
