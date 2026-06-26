<?php

namespace Nexus\Domain\Request\Models\States\VehicleState;

use Spatie\ModelStates\State;
use Spatie\ModelStates\StateConfig;

abstract class VehicleStates extends State
{
    /*
    |--------------------------------------------------------------------------
    | Contract
    |--------------------------------------------------------------------------
    */

    abstract public static function value(): string;

    abstract public static function label(): string;

    abstract public static function colorClass(): string;

    abstract public static function colorFilamentUpdate(): array;

    abstract public static function colorCode(): string;

    /*
    |--------------------------------------------------------------------------
    | Spatie Config
    |--------------------------------------------------------------------------
    */

    public static function config(): StateConfig
    {
        return parent::config()
            ->default(VehiclePendingState::class)
            ->allowAllTransitions();
    }

    /*
    |--------------------------------------------------------------------------
    | Registry
    |--------------------------------------------------------------------------
    */

    public static function options(): array
    {
        return collect(static::all())
            ->mapWithKeys(fn (string $stateClass) => [
                $stateClass::value() => $stateClass::label(),
            ])
            ->toArray();
    }
}