<?php

namespace Nexus\Domain\Request\Models\States\RequestState;

use Spatie\ModelStates\State;
use Spatie\ModelStates\StateConfig;

abstract class RequestStates extends State
{
    /*
    |--------------------------------------------------------------------------
    | Contract
    |--------------------------------------------------------------------------
    */

    abstract public static function value(): string;

    abstract public static function label(): string;

    abstract public static function colorClass(): string;

    abstract public static function colorFilament(): array;

    abstract public static function colorCode(): string;

    abstract public static function colorChart(): array;

    /*
    |--------------------------------------------------------------------------
    | Spatie Config
    |--------------------------------------------------------------------------
    */

    public static function config(): StateConfig
    {
        return parent::config()
            ->default(RequestPendingState::class)
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
            ->mapWithKeys(fn(string $stateClass) => [
                $stateClass::value() => $stateClass::label(),
            ])
            ->toArray();
    }
}
