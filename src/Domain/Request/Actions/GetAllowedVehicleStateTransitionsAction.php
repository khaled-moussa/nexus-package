<?php

namespace Nexus\Domain\Request\Actions;

use Nexus\Domain\Request\Models\States\VehicleState\VehicleAcceptedState;
use Nexus\Domain\Request\Models\States\VehicleState\VehicleCompletedState;
use Nexus\Domain\Request\Models\States\VehicleState\VehicleDeliveredState;
use Nexus\Domain\Request\Models\States\VehicleState\VehicleInProgressState;
use Nexus\Domain\Request\Models\States\VehicleState\VehiclePendingState;
use Nexus\Domain\Request\Models\States\VehicleState\VehicleReceivedState;
use Nexus\Domain\Request\Models\States\VehicleState\VehicleRejectedState;

class GetAllowedVehicleStateTransitionsAction
{
    public static function execute(string $from, string $to): bool
    {
        return in_array($to, self::transitions()[$from] ?? [], true);
    }

    private static function transitions(): array
    {
        return [
            VehiclePendingState::value() => [
                VehiclePendingState::value(),
                VehicleAcceptedState::value(),
                VehicleRejectedState::value(),
            ],

            VehicleAcceptedState::value() => [
                VehiclePendingState::value(),
                VehicleRejectedState::value(),
                VehicleReceivedState::value(),
            ],

            VehicleReceivedState::value() => [
                VehiclePendingState::value(),
                VehicleRejectedState::value(),
                VehicleReceivedState::value(),
                VehicleInProgressState::value(),
            ],

            VehicleInProgressState::value() => [
                VehiclePendingState::value(),
                VehicleRejectedState::value(),
                VehicleInProgressState::value(),
                VehicleCompletedState::value(),
            ],

            VehicleCompletedState::value() => [
                VehiclePendingState::value(),
                VehicleRejectedState::value(),
                VehicleCompletedState::value(),
                VehicleDeliveredState::value(),
            ],

            VehicleDeliveredState::value() => [
                VehiclePendingState::value(),
                VehicleRejectedState::value(),
                VehicleDeliveredState::value(),
            ],
        ];
    }
}
