<?php

namespace Nexus\Domain\Quotation\Listeners;

use Nexus\Domain\Notification\Actions\SendNotificationAction;
use Nexus\Domain\Quotation\Events\WorkshopCreatedQuotation;
use Nexus\Domain\User\Actions\GetUsersAction;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyAdminOfQuotationItemCreated implements ShouldQueue
{
    use InteractsWithQueue;

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

    public function handle(WorkshopCreatedQuotation $event): void
    {
        $request = $event->request;
        $tenant = $event->getTenant();

        // Notify admins
        $this->notify->info(
            title: __('Quotation Created'),
            recipients: $this->users->admins(),

            description: __('Workshop ":workshop" has created a quotation for request #:uuid.', [
                'uuid' => $request->getUuid(),
                'workshop' => $tenant->getName(),
            ]),

            url: route('filament.admin.resources.workshop-requests.view', [
                'record' => $request->getId(),
            ]),
        );
    }
}
