<?php

namespace Nexus\Filament\Pages\Settings;

use Nexus\Domain\Setting\UserSetting\Actions\UpsertUserSettingAction;
use Nexus\Domain\Setting\UserSetting\Dtos\UserSettingDto;
use Nexus\Filament\Clusters\SettingsCluster;
use Nexus\Filament\Components\Actions\ActionButton;
use Nexus\Filament\Components\Forms\Fields\SystemField;
use Nexus\Support\Context\AuthContext;
use Nexus\Support\Enums\ThemeEnum;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Livewire\Attributes\On;
use Illuminate\Contracts\Support\Htmlable;
use BackedEnum;

class GeneralSetting extends Page
{
    protected string $view = 'pages.filament.settings.general-setting';

    protected static ?string $cluster = SettingsCluster::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::AdjustmentsHorizontal;

    protected static ?int $navigationSort = 1;

    protected static ?string $slug = 'general';

    /*
    |--------------------------------------------------------------------------
    | State
    |--------------------------------------------------------------------------
    */

    public ThemeEnum $theme = ThemeEnum::SYSTEM;

    public string $timezone;
    public bool $siteNotificationActive;
    public bool $emailNotificationActive;

    /*
    |--------------------------------------------------------------------------
    | Navigation
    |--------------------------------------------------------------------------
    */

    public function getTitle(): string|Htmlable
    {
        return __('General Setting');
    }

    public static function getNavigationLabel(): string
    {
        return __('General');
    }

    public function getHeading(): string|Htmlable|null
    {
        return __('General Setting');
    }

    /*
    |--------------------------------------------------------------------------
    | Lifecycle
    |--------------------------------------------------------------------------
    */

    public function mount(): void
    {
        $this->loadBrowserTheme();

        $settings = AuthContext::settings();
        $this->timezone = data_get($settings, 'timezone', config('app.timezone'));
        $this->siteNotificationActive = data_get($settings, 'site_notification_active', true);
        $this->emailNotificationActive = data_get($settings, 'email_notification_active', true);
    }

    /*
    |--------------------------------------------------------------------------
    | Header Actions
    |--------------------------------------------------------------------------
    */

    protected function getHeaderActions(): array
    {
        return [
            ActionButton::make(
                name: 'save',
                label: __('Save'),
                action: $this->save(...),
                requiresConfirmation: true,
                sendSuccessNotification: true,
            ),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Form
    |--------------------------------------------------------------------------
    */

    public function form(Schema $schema): Schema
    {
        return $schema->components([
            $this->appearanceSection(),
            $this->notificationSection(),
        ]);
    }

    private function appearanceSection(): Section
    {
        return Section::make(__('Appearance'))
            ->columns(2)
            ->compact()
            ->schema([
                SystemField::theme(),
                SystemField::timezone(),
            ]);
    }

    private function notificationSection(): Section
    {
        return Section::make(__('Notifications'))
            ->columnSpanFull()
            ->compact()
            ->schema([
                SystemField::siteNotification(),
                SystemField::emailNotification(),
            ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Theme
    |--------------------------------------------------------------------------
    */

    #[On('browser-theme-detected')]
    public function resolveBrowserTheme(?string $theme): void
    {
        $this->theme = ThemeEnum::tryFrom($theme ?? '') ?? ThemeEnum::SYSTEM;
    }

    private function loadBrowserTheme(): void
    {
        $this->js(<<<'JS'
            const theme = localStorage.getItem('theme');

            $wire.resolveBrowserTheme(theme);
        JS);
    }

    private function dispatchThemeChanged(): void
    {
        $this->js("
            \$dispatch('theme-changed', '{$this->theme->value}');
        ");
    }


    /*
    |--------------------------------------------------------------------------
    | Actions
    |--------------------------------------------------------------------------
    */

    public function save(): void
    {
        app(UpsertUserSettingAction::class)->execute(
            new UserSettingDto(
                userId: AuthContext::id(),
                timezone: $this->timezone,
                siteNotificationActive: $this->siteNotificationActive,
                emailNotificationActive: $this->emailNotificationActive,
            )
        );

        $this->dispatchThemeChanged();
    }
}
