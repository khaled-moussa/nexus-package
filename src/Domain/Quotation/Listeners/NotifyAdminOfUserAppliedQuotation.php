<?php

namespace Nexus\Domain\Quotation\Listeners;

use Nexus\Domain\Notification\Actions\SendNotificationAction;
use Nexus\Domain\Quotation\Events\UserAppliedQuotationState;
use Nexus\Domain\User\Actions\GetUsersAction;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyAdminOfUserAppliedQuotation implements ShouldQueue
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

    public function handle(UserAppliedQuotationState $event): void
    {
        $request = $event->request;
        $tenant = $event->getTenant();

        // Notify admins
        $this->notify->info(
            title: __('Quotation Status Updated'),
            recipients: $this->users->admins(),

            description: __('The quotation for request #:uuid has been updated by the #:organization.', [
                'uuid' => $request->getUuid(),
                'organization' => $tenant->getName(),
            ]),
            
            url: route('filament.admin.resources.organization-requests.view', [
                'record' => $request->getId(),
            ]),
        );
    }
}
