<?php

namespace Nexus\Filament\Pages\Auth;

use Nexus\Domain\User\Actions\UnlinkUserSocialAccountAction;
use Nexus\Domain\User\Enums\SocialProviderEnum;
use Nexus\Filament\Components\Actions\ActionButton;
use Nexus\Filament\Components\Forms\Fields\EmailField;
use Nexus\Filament\Components\Forms\Fields\PhoneField;
use Nexus\Filament\Components\Forms\Fields\UserField;
use Nexus\Filament\Components\Infolists\Entries\NameEntry;
use Nexus\Filament\Components\Infolists\Entries\StatusEntry;
use Nexus\Filament\Components\Infolists\Sections\CustomSection;
use Nexus\Support\Context\AuthContext;
use Filament\Auth\Pages\EditProfile as BaseEditProfile;
use Filament\Schemas\Components\Component;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Actions\Action;
use Filament\Support\Icons\Heroicon;
use Livewire\Attributes\On;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Override;

class CustomProfile extends BaseEditProfile
{
    /*
    |--------------------------------------------------------------------------
    | Properties
    |--------------------------------------------------------------------------
    */

    protected ?Model $cachedUser = null;

    /*
    |--------------------------------------------------------------------------
    | User
    |--------------------------------------------------------------------------
    */

    #[Override]
    public function getUser(): Authenticatable&Model
    {
        return $this->cachedUser ??= AuthContext::user()
            ->newQuery()
            ->forSocialAccounts()
            ->findOrFail(AuthContext::id());
    }

    /*
    |--------------------------------------------------------------------------
    | Form
    |--------------------------------------------------------------------------
    */

    public function form(Schema $schema): Schema
    {
        return $schema->components([
            $this->personalInfoSection(),
            $this->securitySection(),
            $this->socialAccountsSection(),
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Personal Info
    |--------------------------------------------------------------------------
    */

    private function personalInfoSection(): Section
    {
        return CustomSection::make(__('Personal Information'))
            ->description(__('Update your name, email, and contact details.'))
            ->schema([
                $this->nameSection(),
                $this->contactSection(),
            ]);
    }

    private function nameSection(): Component
    {
        return CustomSection::make()
            ->contained(false)
            ->schema([
                UserField::firstName(),
                UserField::lastName(),
            ]);
    }

    private function contactSection(): Component
    {
        return CustomSection::make()
            ->contained(false)
            ->schema([
                EmailField::make(),
                PhoneField::make(),
            ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Security
    |--------------------------------------------------------------------------
    */

    private function securitySection(): Section
    {
        return CustomSection::make(__('Security'))
            ->description(__('Leave blank to keep your current password.'))
            ->schema([
                $this->getPasswordFormComponent(),
                $this->getPasswordConfirmationFormComponent(),
                $this->getCurrentPasswordFormComponent(),
            ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Social Accounts (MAP BASED - CLEAN VERSION)
    |--------------------------------------------------------------------------
    */

    private function socialAccountsSection(): Section
    {
        return CustomSection::make(__('Connected Accounts'))
            ->description(__('Manage your connected social accounts.'))
            ->collapsible()
            ->schema($this->socialAccountsMappedSchema());
    }

    private function socialAccountsMappedSchema(): array
    {
        return collect(SocialProviderEnum::cases())
            ->map(function (SocialProviderEnum $provider) {
                $user = $this->getUser();
                $isLinked = (bool) data_get($user, "has_{$provider->value}_account");

                return CustomSection::make()
                    ->columns(3)
                    ->schema([
                        NameEntry::make(
                            'provider',
                            hiddenLabel: true,
                            state: $provider->label()
                        ),

                        StatusEntry::boolean(
                            'status',
                            hiddenLabel: true,
                            state: fn() => $isLinked,
                        ),

                        $isLinked ? $this->unlinkAction($provider) : $this->linkAction($provider),
                    ]);
            })
            ->values()
            ->all();
    }

    /*
    |--------------------------------------------------------------------------
    | Actions
    |--------------------------------------------------------------------------
    */

    private function linkAction(SocialProviderEnum $provider): Action
    {
        return ActionButton::sm(
            name: "link_{$provider->value}",
            label: __('Link'),
            icon: Heroicon::OutlinedLink,
            action: fn() => $this->handleLink($provider),
            requiresConfirmation: true,
        );
    }

    private function unlinkAction(SocialProviderEnum $provider): Action
    {
        return ActionButton::sm(
            name: "unlink_{$provider->value}",
            label: __('Unlink'),
            icon: Heroicon::OutlinedLinkSlash,
            action: fn() => $this->handleUnlink($provider),
            requiresConfirmation: true,
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Handlers
    |--------------------------------------------------------------------------
    */

    private function handleLink(SocialProviderEnum $provider): void
    {
        $this->redirectRoute('socialite.redirect', [
            'provider' => $provider->value,
            'meta' => [
                'state' => base64_encode(json_encode([
                    'intent' => 'connect',
                    'redirect' => request()->headers->get('referer'),
                ])),
            ],
        ]);
    }

    private function handleUnlink(SocialProviderEnum $provider): void
    {
        app(UnlinkUserSocialAccountAction::class)->execute(
            AuthContext::user(),
            $provider
        );

        $this->dispatch('refresh');
    }

    /*
    |--------------------------------------------------------------------------
    | Refresh
    |--------------------------------------------------------------------------
    */

    #[On('refresh')]
    public function refreshSocialAccounts() {}
}
