<?php

namespace Nexus\Filament\Clusters;

use Filament\Clusters\Cluster;
use Filament\Pages\Enums\SubNavigationPosition;
use Filament\Support\Icons\Heroicon;
use BackedEnum;

class SettingsCluster extends Cluster
{
    /* 
    |-------------------------------
    | Resource Configuration
    |-------------------------------
    */

    protected static ?SubNavigationPosition $subNavigationPosition = SubNavigationPosition::End;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::AdjustmentsHorizontal;

    protected static ?int $navigationSort = 6;

    /* 
    |-------------------------------
    | Navigation Labels
    |-------------------------------
    */

    public static function getNavigationLabel(): string
    {
        return __('Settings');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('System');
    }
}
