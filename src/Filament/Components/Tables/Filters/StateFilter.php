<?php

namespace Nexus\Filament\Components\Tables\Filters;

use Nexus\Domain\Quotation\Models\States\QuotationState\QuotationStates;
use Nexus\Domain\Request\Models\States\RequestState\RequestStates;
use Nexus\Domain\Request\Models\States\VehicleState\VehicleStates;
use Filament\Tables\Filters\SelectFilter;

class StateFilter
{
    /*
    |--------------------------------------------------------------------------
    | Gender
    |--------------------------------------------------------------------------
    */

    public static function requestState(
        string $name = 'request_state',
        ?string $label = 'Request State',
    ): SelectFilter {

        return SelectFilter::make($name)
            ->label($label ? __($label) : null)
            ->options(RequestStates::options())
            ->native(false);
    }

    /*
    |--------------------------------------------------------------------------
    | Gender
    |--------------------------------------------------------------------------
    */

    public static function vehicleState(
        string $name = 'vehicle_state',
        ?string $label = 'Vehicle State',
    ): SelectFilter {

        return SelectFilter::make($name)
            ->label($label ? __($label) : null)
            ->options(VehicleStates::options())
            ->native(false);
    }

    /*
    |--------------------------------------------------------------------------
    | Gender
    |--------------------------------------------------------------------------
    */

    public static function quotationState(
        string $name = 'quotation_state',
        ?string $label = 'Quotation State',
    ): SelectFilter {

        return SelectFilter::make($name)
            ->label($label ? __($label) : null)
            ->options(QuotationStates::options())
            ->native(false);
    }
}
