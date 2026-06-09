<?php

namespace Nexus\Filament\Components\Actions;

use Closure;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\ActionGroup;
use Filament\Support\Enums\Size;

class GroupedActionsButton
{
    public static function actions(
        bool|Closure $canView = true,
        bool|Closure $canEdit = true,
        bool|Closure $canDelete = true,
        array $extraActions = [],
    ): array|ActionGroup|null {

        $actions = [];

        /*
        |--------------------------------------------------------------------------
        | Resolve permissions
        |--------------------------------------------------------------------------
        */

        $canView = $canView instanceof Closure ? $canView() : $canView;
        $canEdit = $canEdit instanceof Closure ? $canEdit() : $canEdit;
        $canDelete = $canDelete instanceof Closure ? $canDelete() : $canDelete;

        /*
        |--------------------------------------------------------------------------
        | Core Actions
        |--------------------------------------------------------------------------
        */

        if ($canView) {
            $actions[] = ViewAction::make();
        }

        if ($canEdit) {
            $actions[] = EditAction::make();
        }

        if ($canDelete) {
            $actions[] = DeleteAction::make();
        }

        /*
        |--------------------------------------------------------------------------
        | Extra Actions
        |--------------------------------------------------------------------------
        */

        $actions = array_merge($actions, $extraActions);

        /*
        |--------------------------------------------------------------------------
        | Empty State
        |--------------------------------------------------------------------------
        */

        if (empty($actions)) {
            return null;
        }

        /*
        |--------------------------------------------------------------------------
        | Single Action Optimization
        |--------------------------------------------------------------------------
        */

        if (count($actions) === 1) {
            return [$actions[0]];
        }

        /*
        |--------------------------------------------------------------------------
        | Grouped Actions
        |--------------------------------------------------------------------------
        */

        return ActionGroup::make($actions)
            ->label(__('Actions'))
            ->size(Size::ExtraSmall)
            ->button()
            ->outlined();
    }
}
