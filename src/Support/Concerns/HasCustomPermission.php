<?php

namespace Nexus\Support\Concerns;

use Nexus\Support\Context\AuthContext;
use Illuminate\Auth\Access\Response;
use Illuminate\Database\Eloquent\Model;

trait HasCustomPermission
{
    /*
    |--------------------------------------------------------------------------
    | Core
    |--------------------------------------------------------------------------
    */

    public static function hasPermission(string $action): Response
    {
        $permission = sprintf(
            '%s:%s:%s',
            $action,
            static::getModelLabel(),
            filament()->getCurrentPanel()->getId(),
        );

        return AuthContext::user()->can($permission)
            ? Response::allow()
            : Response::deny(__('You do not have permission to perform this action.'));
    }

    /*
    |--------------------------------------------------------------------------
    | Authorization Responses
    |--------------------------------------------------------------------------
    */

    public static function getViewAnyAuthorizationResponse(): Response
    {
        return static::hasPermission('ViewAny');
    }

    public static function getViewAuthorizationResponse(Model $record): Response
    {
        return static::hasPermission('View');
    }

    public static function getCreateAuthorizationResponse(): Response
    {
        return static::hasPermission('Create');
    }

    public static function getEditAuthorizationResponse(Model $record): Response
    {
        return static::hasPermission('Update');
    }

    public static function getDeleteAuthorizationResponse(Model $record): Response
    {
        return static::hasPermission('Delete');
    }

    public static function getDeleteAnyAuthorizationResponse(): Response
    {
        return static::hasPermission('DeleteAny');
    }

    public static function getForceDeleteAuthorizationResponse(Model $record): Response
    {
        return static::hasPermission('ForceDelete');
    }
}
