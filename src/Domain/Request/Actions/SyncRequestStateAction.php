<?php

namespace Nexus\Domain\Request\Actions;

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

        $requestState = $request->getRequestState();

        if ($this->allRejected($vehicles)) {
            $this->transition($requestState, RequestRejectedState::class, $request);

            return;
        }

        if ($this->hasInProgress($vehicles)) {
            $this->transition($requestState, RequestInProgressState::class, $request);

            return;
        }

        if ($this->allReceived($vehicles)) {
            $this->transition($requestState, RequestReceivedState::class, $request);

            return;
        }

        if ($this->allCompleted($vehicles)) {
            $this->transition($requestState, RequestCompletedState::class, $request);

            return;
        }

        if ($this->allDelivered($vehicles)) {
            $this->transition($requestState, RequestDeliveredState::class, $request);

            return;
        }

        if ($this->allAccepted($vehicles)) {
            $this->transition($requestState, RequestAcceptedState::class, $request);
            
            return;
        }

        $this->transition($requestState, RequestPendingState::class, $request);
    }

    /*
    |--------------------------------------------------------------------------
    | Transition
    |--------------------------------------------------------------------------
    */

    private function transition(
        RequestStates $state,
        string $to,
        Request|RequestWorkshop $request,
    ): void {
        // Skip unnecessary transition
        if ($state::class === $to) {
            return;
        }

        $state->transitionTo($to);

        $this->updateRequestTimestamps->execute($request);
    }

    /*
    |--------------------------------------------------------------------------
    | State Rules
    |--------------------------------------------------------------------------
    */

    private function allRejected($vehicles): bool
    {
        return $vehicles->every(fn($vehicle) => $vehicle->rejected());
    }

    private function hasInProgress($vehicles): bool
    {
        return $vehicles->contains(fn($vehicle) => $vehicle->inProgress());
    }

    private function allCompleted($vehicles): bool
    {
        return $vehicles
            ->reject(fn($vehicle) => $vehicle->rejected())
            ->every(fn($vehicle) => $vehicle->completed());
    }

    private function allAccepted($vehicles): bool
    {
        return $vehicles
            ->reject(fn($vehicle) => $vehicle->rejected())
            ->every(fn($vehicle) => $vehicle->accepted());
    }

    private function allReceived($vehicles): bool
    {
        return $vehicles
            ->reject(fn($vehicle) => $vehicle->rejected())
            ->every(fn($vehicle) => $vehicle->received());
    }

    private function allDelivered($vehicles): bool
    {
        return $vehicles
            ->reject(fn($vehicle) => $vehicle->rejected())
            ->every(fn($vehicle) => $vehicle->delivered());
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    private function resolveVehicles(Request|RequestWorkshop $request)
    {
        return match (true) {
            $request instanceof Request => $request->getRelation('vehicles'),
            $request instanceof RequestWorkshop => $request->getRelation('workshopVehicles'),
        };
    }
}
