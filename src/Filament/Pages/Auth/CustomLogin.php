<?php

namespace Nexus\Filament\Pages\Auth;

use Nexus\Domain\User\Enums\SocialProviderEnum;
use Nexus\Filament\Components\Notifications\NotificationComponent;
use Filament\Actions\Action;
use Filament\Auth\Pages\Login as BaseLogin;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Override;

class CustomLogin extends BaseLogin
{

    #[Override]
    public function mount(): void
    {
        parent::mount();

        $this->handleAuthFailedNotification();
    }


    /*
    |--------------------------------------------------------------------------
    | Form
    |--------------------------------------------------------------------------
    */

    public function form(Schema $schema): Schema
    {
        return $schema->components([
            $this->getEmailFormComponent(),
            $this->getPasswordFormComponent(),
            $this->getRememberFormComponent(),
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Actions
    |--------------------------------------------------------------------------
    */

    protected function getFormActions(): array
    {
        return [
            Section::make()
                ->schema([
                    Actions::make([
                        $this->getAuthenticateFormAction(),
                    ])->fullWidth(),

                    Actions::make([
                        $this->getSocialLoginAction(SocialProviderEnum::GOOGLE),
                    ])->fullWidth(),
                ])
                ->contained(false)
                ->columnSpanFull(),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Social Login
    |--------------------------------------------------------------------------
    */

    private function getSocialLoginAction(SocialProviderEnum $provider): Action
    {
        return Action::make("login_{$provider->value}")
            ->label("Continue with {$provider->label()}")
            ->url(route('socialite.redirect', [
                'provider' => $provider->value,
            ]));
    }


    /*
    |--------------------------------------------------------------------------
    | Handle Expcetion
    |--------------------------------------------------------------------------
    */

    private function handleAuthFailedNotification(): void
    {
        $message = session('auth_failed');

        if (! $message) {
            return;
        }

        NotificationComponent::error($message);

        session()->forget('auth_failed');
    }
}
