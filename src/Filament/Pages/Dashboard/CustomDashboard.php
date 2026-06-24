<?php

namespace Nexus\Filament\Pages\Dashboard;

use Filament\Forms\Components\DatePicker;
use Nexus\Filament\Components\Actions\ActionButton;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Pages\Dashboard\Actions\FilterAction;
use Filament\Pages\Dashboard\Concerns\HasFiltersAction;
use Filament\Support\Icons\Heroicon;
use Filament\Support\Enums\Size;
use Illuminate\Contracts\Support\Htmlable;
use BackedEnum;

class CustomDashboard extends BaseDashboard
{
    use HasFiltersAction;

    /*
    |--------------------------------------------------------------------------
    | Core Configuration
    |--------------------------------------------------------------------------
    */

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedSquares2x2;

    protected static ?int $navigationSort = 0;

    protected static ?string $slug = 'dashboard';

    /*
    |--------------------------------------------------------------------------
    | Navigation
    |--------------------------------------------------------------------------
    */

    public function getTitle(): string|Htmlable
    {
        return __('Dashboard');
    }

    /*
    |--------------------------------------------------------------------------
    | Header Actions
    |--------------------------------------------------------------------------
    */

    protected function getHeaderActions(): array
    {
        return [
            FilterAction::make()
                ->schema([
                    DatePicker::make('startDate')
                        ->placeholder(__('Start date'))
                        ->prefixIcon(Heroicon::OutlinedCalendar)
                        ->native(false),

                    DatePicker::make('endDate')
                        ->placeholder(__('End date'))
                        ->prefixIcon(Heroicon::OutlinedCalendar)
                        ->native(false),
                ])
                ->extraModalFooterActions([
                    ActionButton::make(
                        name: 'reset_filter',
                        label: __('Reset Filter'),
                        icon: Heroicon::Funnel,
                        size: Size::Medium,
                        action: fn() => $this->resetFilters(),
                    )->cancelParentActions(),
                ]),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Actions
    |--------------------------------------------------------------------------
    */

    private function resetFilters(): void
    {
        $this->filters = [];
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    public function persistsFiltersInSession(): bool
    {
        return false;
    }
}
