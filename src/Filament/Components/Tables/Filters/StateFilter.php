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
    | Base Builder
    |--------------------------------------------------------------------------
    */

    public static function make(
        string $name,
        string $stateClass,
        ?string $label = null,
    ): SelectFilter {

        return SelectFilter::make($name)
            ->options($stateClass::options())
            ->native(false)
            ->when($label, fn(SelectFilter $filter) => $filter->label(__($label)));
    }

    /*
    |--------------------------------------------------------------------------
    | Request State
    |--------------------------------------------------------------------------
    */

    public static function requestState(
        string $name = 'request_state',
        ?string $label = 'Request State',
    ): SelectFilter {

        return self::make(
            name: $name,
            stateClass: RequestStates::class,
            label: $label,
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Vehicle State
    |--------------------------------------------------------------------------
    */

    public static function vehicleState(
        string $name = 'vehicle_state',
        ?string $label = 'Vehicle State',
    ): SelectFilter {
        return self::make(

            name: $name,
            stateClass: VehicleStates::class,
            label: $label,
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Quotation State
    |--------------------------------------------------------------------------
    */

    public static function quotationState(
        string $name = 'quotation_state',
        ?string $label = 'Quotation State',
    ): SelectFilter {
        return self::make(
            
            name: $name,
            stateClass: QuotationStates::class,
            label: $label,
        );
    }
}
