<?php

namespace Nexus\Domain\Request\Actions;

use Nexus\Domain\Request\Models\Request;
use Nexus\Domain\Request\Models\RequestWorkshop;
use Nexus\Domain\Request\Models\States\RequestState\RequestCompletedState;
use Nexus\Domain\Request\Models\States\RequestState\RequestDeliveredState;
use Nexus\Domain\Request\Models\States\RequestState\RequestReceivedState;

class UpdateRequestTimestampsAction
{
    /*
    |--------------------------------------------------------------------------
    | Execute
    |--------------------------------------------------------------------------
    */

    public function execute(Request|RequestWorkshop $request): void
    {
        $state = $request->getRequestState()->value();

        match ($state) {
            RequestReceivedState::value() => $this->updateReceived($request),
            RequestCompletedState::value() => $this->updateCompleted($request),
            RequestDeliveredState::value() => $this->updateDelivered($request),
            default => $this->reset($request),
        };
    }

    /*
    |--------------------------------------------------------------------------
    | State Handlers
    |--------------------------------------------------------------------------
    */

    private function updateReceived(Request|RequestWorkshop $request): void
    {
        if ($request->received_at === null) {
            $request->update([
                'received_at' => now(),
            ]);
        }
    }

    private function updateCompleted(Request|RequestWorkshop $request): void
    {
        $request->update([
            'completed_at' => $request->completed_at ?? now(),
        ]);
    }

    private function updateDelivered(Request|RequestWorkshop $request): void
    {
        $request->update([
            'delivered_at' => $request->delivered_at ?? now(),
        ]);
    }

    private function reset(Request|RequestWorkshop $request): void
    {
        $request->update([
            'received_at'  => null,
            'completed_at' => null,
            'delivered_at' => null,
        ]);
    }
}