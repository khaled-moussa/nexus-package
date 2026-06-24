<?php

namespace Nexus\Filament\Preset;

use CraftForge\FilamentLanguageSwitcher\FilamentLanguageSwitcherPlugin;
use Nexus\Domain\Auth\Middlewares\CustomAuthenticate;
use Nexus\Domain\Panel\Enums\PanelTypeEnum;
use Nexus\Filament\Pages\Dashboard\CustomDashboard;
use Nexus\Filament\Pages\Settings\GeneralSetting;
use Nexus\Filament\Pages\Auth\CustomProfile;
use Filament\Enums\ThemeMode;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Panel;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Nexus\Filament\Widgets\CustomAccountWidget;

class PanelPreset
{
    /*
    |--------------------------------------------------------------------------
    | Shared Panel Configuration
    |--------------------------------------------------------------------------
    */

    public static function apply(Panel $panel, PanelTypeEnum $panelId, bool $default = false): Panel
    {

        return $panel

            /*
            |--------------------------------------------------------------------------
            | Panel Identity
            |--------------------------------------------------------------------------
            */

            ->default($default)
            ->id($panelId->value)
            ->path($panelId->value)

            /*
            |--------------------------------------------------------------------------
            | Auto Discovery
            |--------------------------------------------------------------------------
            */

             ->discoverClusters(
                in: app_path('Filament/Panels/Admin/Clusters'),
                for: 'App\\Filament\\Panels\\Admin\\Clusters'
            )

            /*
            |--------------------------------------------------------------------------
            | Authentication
            |--------------------------------------------------------------------------
            */

            ->profile(CustomProfile::class, isSimple: true)

            /*
            |--------------------------------------------------------------------------
            | Notifications
            |--------------------------------------------------------------------------
            */

            ->databaseNotifications()

            /*
            |--------------------------------------------------------------------------
            | Appearance
            |--------------------------------------------------------------------------
            */

            ->brandName(config('company.brand_name'))
            // ->brandLogo(asset(config('company.panel_logo_light')))
            // ->darkModeBrandLogo(asset(config('company.panel_logo_dark')))
            // ->brandLogoHeight('30px')

            ->font('Poppins')
            ->defaultThemeMode(ThemeMode::System)

            ->sidebarCollapsibleOnDesktop()
            ->sidebarWidth('350px')
            ->collapsedSidebarWidth('6rem')
            ->globalSearch(false)

            /*
            |--------------------------------------------------------------------------
            | Vite
            |--------------------------------------------------------------------------
            */

            ->viteTheme('resources/css/filament/theme.css');
    }

    /*
    |--------------------------------------------------------------------------
    | Filament Plugins
    |--------------------------------------------------------------------------
    */

    public static function sharedPages(): array
    {
        return [
            CustomDashboard::class,
            GeneralSetting::class,
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Filament Plugins
    |--------------------------------------------------------------------------
    */

    public static function sharedWidgets(): array
    {
        return [
            CustomAccountWidget::class,
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Filament Plugins
    |--------------------------------------------------------------------------
    */

    public static function sharedPlugins(): array
    {
        return [
            FilamentLanguageSwitcherPlugin::make()
                ->locales(['en', 'ar']),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Middleware Stack
    |--------------------------------------------------------------------------
    */

    public static function sharedMiddleware(): array
    {
        return [
            EncryptCookies::class,
            AddQueuedCookiesToResponse::class,
            StartSession::class,
            AuthenticateSession::class,
            ShareErrorsFromSession::class,
            VerifyCsrfToken::class,
            SubstituteBindings::class,
            DisableBladeIconComponents::class,
            DispatchServingFilamentEvent::class,
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Authentication Middleware
    |--------------------------------------------------------------------------
    */

    public static function sharedAuthMiddleware(): array
    {
        return [
            CustomAuthenticate::class,
        ];
    }
}
