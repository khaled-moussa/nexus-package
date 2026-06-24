<?php

namespace Nexus\Filament\Components\Forms\Fields;

use Nexus\Filament\Components\Infolists\Sections\CustomSection;
use Nexus\Domain\Request\Enums\VehicleServiceTypeEnum;
use Nexus\Domain\Request\Models\States\VehicleState\VehicleStates;
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
    | Base Builder
    |--------------------------------------------------------------------------
    */

    private static function make(
        string $name,
        string $label,
        bool $required = true,
        int $maxLength = 255
    ): TextInput {

        return NameField::make(
            name: $name,
            label: $label,
            required: $required,
            maxLength: $maxLength
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Vehicle Fields
    |--------------------------------------------------------------------------
    */

    /*
    |-------------------------
    | Manufacturer Field
    |-------------------------
    */

    public static function manufacturer(
        string $name = 'manufacturer',
        ?string $label = 'Manufacturer'
    ): TextInput {

        return self::make(
            name: $name,
            label: $label,
        );
    }

    /*
    |-------------------------
    | Model Field
    |-------------------------
    */

    public static function model(
        string $name = 'model',
        ?string $label = 'Model'
    ): TextInput {

        return self::make(
            name: $name,
            label: $label,
        );
    }

    /*
    |-------------------------
    | Manufacturer Field
    |-------------------------
    */

    public static function modelYear(
        string $name = 'model_year',
        ?string $label = 'Model Year'
    ): TextInput {

        return NumericField::make(
            name: $name,
            label: $label,
            minValue: 1900,
            maxValue: now()->year,
            required: true,
        );
    }

    /*
    |-------------------------
    | Plate Number Field
    |-------------------------
    */

    public static function plateNumber(
        string $name = 'plate_number',
        ?string $label = 'Plate Number'
    ): TextInput {

        return self::make(
            name: $name,
            label: $label,
            maxLength: 50
        );
    }

    /*
    |-------------------------
    | VIN Number Field
    |-------------------------
    */

    public static function vinNumber(
        string $name = 'vin_number',
        ?string $label = 'VIN Number'
    ): TextInput {

        return self::make(
            name: $name,
            label: $label,
            maxLength: 50
        );
    }

    /*
    |-------------------------
    | Manufacturer Field
    |-------------------------
    */

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

    /*
    |-------------------------
    | Manufacturer Field
    |-------------------------
    */

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
    |-------------------------
    | Issue Field
    |-------------------------
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

    /*
    |-------------------------
    | Comments Field
    |-------------------------
    */

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

    /*
    |-------------------------
    | Country Field
    |-------------------------
    */

    public static function country(): Select
    {
        return AddressField::country(required: false);
    }

    /*
    |-------------------------
    | City Field
    |-------------------------
    */

    public static function city(): Select
    {
        return AddressField::city(required: false);
    }

    /*
    |-------------------------
    | Vehicle State Field
    |-------------------------
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

    /*
    |-------------------------
    | Can Edit Field
    |-------------------------
    */

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
    | Ready Sections
    |--------------------------------------------------------------------------
    */

    /*
    |-------------------------
    | Issue & Comment Section
    |-------------------------
    */

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
    |-------------------------
    | County & City Group
    |-------------------------
    */

    public static function countryAndCityGrouped(): FusedGroup
    {
        return FusedGroup::make([self::country(), self::city()])
            ->label(__('Location'))
            ->columns(2)
            ->columnSpan(2);
    }
}
