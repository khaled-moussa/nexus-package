<?php

namespace Nexus\Filament\Components\Actions;

use Nexus\Domain\User\Models\User;
use Nexus\Domain\User\Actions\ResetUserPasswordAction;
use Filament\Support\Enums\Size;
use Filament\Support\Icons\Heroicon;
use Filament\Actions\Action;

class ResetPasswordActionButton
{
    public static function make(): Action
    {
        return Action::make('reset_password')
            ->label(__('Send Set Password'))
            ->icon(Heroicon::OutlinedKey)
            ->size(Size::ExtraSmall)
            ->button()
            ->requiresConfirmation()
            ->rateLimit(3)
            ->modalHeading(__('Send Password Setup Email'))
            ->modalDescription(__('A password setup email will be sent to this user.'))
            ->modalSubmitActionLabel(__('Send Email'))
            ->action(fn(User $record) => self::handle($record))
            ->successNotificationTitle(__('Password setup email sent successfully.'));
    }

    private static function handle(User $user): void
    {
        app(ResetUserPasswordAction::class)->execute($user);
    }
}
