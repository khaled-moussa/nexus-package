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
        $timestamps = [
            'completed_at' => null,
            'received_at'  => null,
            'delivered_at' => null,
        ];

        $column = match ($request->getRequestState()->value()) {
            RequestCompletedState::value() => 'completed_at',
            RequestReceivedState::value()  => 'received_at',
            RequestDeliveredState::value() => 'delivered_at',
            default                        => null,
        };

        if ($column !== null) {
            $timestamps[$column] = now();
        }

        $request->update($timestamps);
    }
}