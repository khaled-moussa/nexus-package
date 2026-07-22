<?php

namespace Nexus\Domain\Request\Actions;

use Illuminate\Support\Collection;
use Nexus\Domain\Request\Models\Request;
use Nexus\Domain\Request\Models\RequestWorkshop;
use Nexus\Domain\Request\Models\States\RequestState\RequestAcceptedState;
use Nexus\Domain\Request\Models\States\RequestState\RequestCompletedState;
use Nexus\Domain\Request\Models\States\RequestState\RequestDeliveredState;
use Nexus\Domain\Request\Models\States\RequestState\RequestInProgressState;
use Nexus\Domain\Request\Models\States\RequestState\RequestPendingState;
use Nexus\Domain\Request\Models\States\RequestState\RequestReceivedState;
use Nexus\Domain\Request\Models\States\RequestState\RequestRejectedState;
use Nexus\Domain\Request\Models\States\RequestState\RequestStates;

class SyncRequestStateAction
{
    /*
    |--------------------------------------------------------------------------
    | Constructor
    |--------------------------------------------------------------------------
    */

    public function __construct(
        private readonly UpdateRequestTimestampsAction $updateRequestTimestamps,
    ) {}

    /*
    |--------------------------------------------------------------------------
    | Execute
    |--------------------------------------------------------------------------
    */

    public function execute(Request|RequestWorkshop $request): void
    {
        $vehicles = $this->resolveVehicles($request);

        if ($vehicles->isEmpty()) {
            return;
        }

        $this->transition(
            state: $request->getRequestState(),
            to: $this->resolveState($vehicles),
            request: $request,
        );
    }

    /*
    |--------------------------------------------------------------------------
    | State Resolution
    |--------------------------------------------------------------------------
    */

    private function resolveState(Collection $vehicles): string
    {
        // 1. Any pending → Pending 
        if ($vehicles->contains(fn($v) => $v->pending())) {
            return RequestPendingState::class;
        }

        // 2. Any in-progress → InProgress 
        if ($vehicles->contains(fn($v) => $v->inProgress())) {
            return RequestInProgressState::class;
        }

        // 3. All rejected → Rejected 
        if ($vehicles->every(fn($v) => $v->rejected())) {
            return RequestRejectedState::class;
        }

        // Non-rejected vehicles only (ignore rejected from here on) 
        $active = $vehicles->reject(fn($v) => $v->rejected());

        // 4. All delivered → Delivered
        if ($active->every(fn($v) => $v->delivered())) {
            return RequestDeliveredState::class;
        }

        // 5. All completed (or delivered) → Completed
        if ($active->every(fn($v) => $v->completed() || $v->delivered())) {
            return RequestCompletedState::class;
        }

        // 6. All received (or completed/delivered) → Received 
        if ($active->every(fn($v) => $v->received() || $v->completed() || $v->delivered())) {
            return RequestReceivedState::class;
        }

        // 7. All accepted (or received/completed/delivered) → Accepted
        if ($active->every(fn($v) => $v->accepted() || $v->received() || $v->completed() || $v->delivered())) {
            return RequestAcceptedState::class;
        }

        // 8. Default → Pending
        return RequestPendingState::class;
    }

    /*
    |--------------------------------------------------------------------------
    | Transition
    |--------------------------------------------------------------------------
    */

    private function transition(RequestStates $state, string $to, Request|RequestWorkshop $request): void
    {
        if ($state::class === $to) {
            return;
        }

        $state->transitionTo($to);

        $this->updateRequestTimestamps->execute($request);
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    private function resolveVehicles(Request|RequestWorkshop $request): Collection
    {
        return match (true) {
            $request instanceof Request          => $request->getRelation('vehicles'),
            $request instanceof RequestWorkshop  => $request->getRelation('workshopVehicles'),
        };
    }
}
