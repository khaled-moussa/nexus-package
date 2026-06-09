<?php

namespace Nexus\Domain\Quotation\Listeners;

use Nexus\Domain\Notification\Actions\SendNotificationAction;
use Nexus\Domain\Quotation\Events\AdminAppliedQuotationState;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyWorkshopOfAdminAppliedQuotation implements ShouldQueue
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

    public function handle(AdminAppliedQuotationState $event): void
    {
        $request = $event->request;
        $owner = $event->getOwner();
        $tenant = $event->getTenant();

        // Notify admins
        $this->notify->info(
            title: __('Quotation Status Updated'),
            recipients: $owner,

            description: __('The quotation for request #:uuid has been updated by the scopes.', [
                'uuid' => $request->getUuid(),
            ]),

            url: route('filament.workshop.resources.requests.view', [
                'record' => $request->getId(),
                'tenant' => $tenant->getUuid(),
            ]),
        );
    }
}
