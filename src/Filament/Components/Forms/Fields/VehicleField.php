<?php

namespace Nexus\Filament\Components\Forms\Fields;

use Nexus\Domain\Request\Enums\VehicleServiceTypeEnum;
use Nexus\Domain\Request\Models\States\VehicleState\VehicleStates;
use Nexus\Filament\Components\Infolists\Sections\CustomSection;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\FusedGroup;
use Filament\Schemas\Components\Section;

class VehicleField
{
    /*
    |--------------------------------------------------------------------------
    | Vehicle Information
    |--------------------------------------------------------------------------
    */

    public static function manufacturer(
        string $name = 'manufacturer',
        ?string $label = 'Manufacturer'
    ): TextInput {
        return self::text(
            $name,
            label: $label,
        )->autocomplete($name);
    }

    public static function model(
        string $name = 'model',
        ?string $label = 'Model'
    ): TextInput {
        return self::text(
            name: $name,
            label: $label,
        )->autocomplete($name);
    }

    public static function modelYear(
        string $name = 'model_year',
        ?string $label = 'Model Year'
    ): TextInput {
        return TextInput::make($name)
            ->label($label ? __($label) : null)
            ->numeric()
            ->minValue(1900)
            ->maxValue(now()->year)
            ->required();
    }

    public static function plateNumber(
        string $name = 'plate_number',
        ?string $label = 'Plate Number'
    ): TextInput {
        return self::text(
            $name,
            label: $label,
            maxLength: 50
        );
    }

    public static function vinNumber(
        string $name = 'vin_number',
        ?string $label = 'VIN Number'
    ): TextInput {
        return self::text(
            $name,
            label: $label,
            maxLength: 50
        );
    }

    public static function kilometers(
        string $name = 'kilometers',
        ?string $label = 'Kilometers'
    ): TextInput {
        return NumericField::make(
            name: $name,
            label: $label,
            required: false
        );
    }

    public static function serviceType(
        string $name = 'service_type',
        ?string $label = 'Service Type'
    ): Select {
        return SelectField::make(
            name: $name,
            label: $label,
            options: VehicleServiceTypeEnum::options()
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Issue & Comments
    |--------------------------------------------------------------------------
    */

    public static function descriptionIssue(
        string $name = 'issue_description',
        ?string $label = 'Issue Description'
    ): Textarea {
        return DescriptionField::medium(
            name: $name,
            label: $label,
        );
    }

    public static function descriptionComment(
        string $name = 'comments',
        ?string $label = 'Comments'
    ): Textarea {
        return DescriptionField::medium(
            name: $name,
            label: $label,
            required: false,
        );
    }

    public static function descriptionIssueAndComment(): Section
    {
        return CustomSection::make(__('Issue Information'))
            ->collapsible()
            ->schema([
                self::descriptionIssue(),
                self::descriptionComment(),
            ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Location
    |--------------------------------------------------------------------------
    */

    public static function country(): Select
    {
        return AddressField::country(required: false);
    }

    public static function city(): Select
    {
        return AddressField::city(required: false);
    }

    public static function countryAndCityGrouped(): FusedGroup
    {
        return FusedGroup::make([self::country(), self::city()])
            ->label(__('Location'))
            ->columns(2)
            ->columnSpan(2);
    }

    /*
    |--------------------------------------------------------------------------
    | State & Permissions
    |--------------------------------------------------------------------------
    */

    public static function vehicleState(
        string $name = 'vehicle_state',
        ?string $label = 'Vehicle State'
    ): Select {
        return SelectField::make(
            name: $name,
            label: $label,
            options: VehicleStates::options()
        );
    }

    public static function canEdit(
        string $name = 'can_edit',
        ?string $label = 'Can Edit'
    ): Toggle {
        return ToggleField::make(
            name: $name,
            label: $label,
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    private static function text(
        string $name,
        string $label,
        int $maxLength = 255
    ): TextInput {
        return TextInput::make($name)
            ->label($label ? __($label) : null)
            ->required()
            ->maxLength($maxLength);
    }
}
