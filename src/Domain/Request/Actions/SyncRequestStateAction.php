<?php

namespace Nexus\Domain\Request\Actions;

use Nexus\Domain\Request\Models\Request;
use Nexus\Domain\Request\Models\RequestWorkshop;
use Nexus\Domain\Request\Models\States\RequestState\RequestAcceptedState;
use Nexus\Domain\Request\Models\States\RequestState\RequestCompletedState;
use Nexus\Domain\Request\Models\States\RequestState\RequestInProgressState;
use Nexus\Domain\Request\Models\States\RequestState\RequestRejectedState;

class SyncRequestStateAction
{
    /*
    |--------------------------------------------------------------------------
    | Execute
    |--------------------------------------------------------------------------
    */

    public function execute(Request|RequestWorkshop $request): void
    {
        $vehicles = $this->resolveVehicles($request);

        $requestState = $request->getRequestState();

        if ($vehicles->isEmpty()) {
            return;
        }

        if ($this->allRejected($vehicles)) {
            $requestState->transitionTo(RequestRejectedState::class);
            return;
        }

        if ($this->hasInProgress($vehicles)) {
            $requestState->transitionTo(RequestInProgressState::class);
            return;
        }

        if ($this->allCompleted($vehicles)) {
            $requestState->transitionTo(RequestCompletedState::class);
            return;
        }

        if ($this->allAccepted($vehicles)) {
            $requestState->transitionTo(RequestAcceptedState::class);
        }

        // Handle timestamp for stats like completed at, ...
        // app(UpdateRequestTimestampsAction::class)->execute($request);
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
