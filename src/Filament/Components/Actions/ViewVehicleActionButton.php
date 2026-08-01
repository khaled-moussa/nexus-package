<?php

namespace Nexus\Filament\Components\Actions;

use Filament\Actions\Action;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class ViewVehicleActionButton
{
    public static function make(array $components): Action
    {
        return ActionButton::make(
            name: 'view_vehicles',
            label: 'View Vehicles',
            icon: Heroicon::OutlinedTruck,
            isButton: false,
        )
            ->modalHeading(__('Vehicles'))
            ->modalDescription(__('View vehicles and manage quotations for each.'))
            ->infolist(fn(Schema $schema, $record) => $schema->record($record)->components($components))
            ->modalSubmitAction(false)
            ->modalCancelActionLabel(__('Close'));
    }
}
