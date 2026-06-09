<?php

namespace Nexus\Filament\Components\Actions;

use Nexus\Domain\User\Actions\VerifyUserEmailAction;
use Nexus\Domain\User\Models\User;
use Filament\Actions\Action;
use Filament\Support\Enums\Size;
use Filament\Support\Icons\Heroicon;

class VerifiedEmailActionButton
{
    /*
    |--------------------------------------------------------------------------
    | Factory
    |--------------------------------------------------------------------------
    */

    public static function make(): Action
    {
        return Action::make('verify_email')
            ->label(__('Verify Email'))
            ->icon(Heroicon::OutlinedCheckCircle)
            ->size(Size::ExtraSmall)
            ->button()
            ->requiresConfirmation()
            ->rateLimit(3)
            ->visible(fn(User $record): bool => ! $record->hasVerifiedEmail())
            ->action(fn(User $record) => self::handle($record))
            ->modalHeading(__('Verify Email'))
            ->modalDescription(__('This user email will be marked as verified.'))
            ->modalSubmitActionLabel(__('Verify'))
            ->successNotificationTitle(__('Email verified successfully.'));
    }

    /*
    |--------------------------------------------------------------------------
    | Handle
    |--------------------------------------------------------------------------
    */

    private static function handle(User $user): void
    {
        app(VerifyUserEmailAction::class)->execute($user);
    }
}
