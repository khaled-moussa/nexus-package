<?php

namespace Nexus\Domain\Quotation\Listeners;

use Nexus\Domain\Notification\Actions\SendNotificationAction;
use Nexus\Domain\Quotation\Events\AdminCreatedQuotation;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyOwnerOfQuotationItemCreated implements ShouldQueue
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

    public function handle(AdminCreatedQuotation $event): void
    {
        $request = $event->request;
        $owner = $event->getOwner();
        $tenant = $event->getTenant();

        // Notify admins
        $this->notify->info(
            title: __('New Quotation Added'),
            recipients: $owner,

            description: __('A new quotation has been added to request #:uuid and is ready for review.', [
                'uuid' => $request->getUuid(),
            ]),
            
            url: route('filament.organization.resources.requests.view', [
                'record' => $request->getId(),
                'tenant' => $tenant->getUuid(),
            ]),
        );
    }
}
