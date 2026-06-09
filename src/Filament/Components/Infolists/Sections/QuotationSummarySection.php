<?php

namespace Nexus\Filament\Components\Infolists\Sections;

use Nexus\Filament\Components\Infolists\Entries\NumericEntry;
use Nexus\Filament\Components\Infolists\Sections\CustomSection;
use Filament\Schemas\Components\Section;

class QuotationSummarySection
{
    /*
    |--------------------------------------------------------------------------
    | Base Builder
    |--------------------------------------------------------------------------
    */

    public static function make(): Section
    {
        return CustomSection::default(__('Quotation'))
            ->description(__('Final calculated quotation after acceptance.'))
            ->columns(4)
            ->schema([
                NumericEntry::money(
                    'quotation.total',
                    'Total Price',
                ),

                NumericEntry::money(
                    'quotation.discount_total',
                    'Total Sale',
                ),

                NumericEntry::money(
                    'quotation.tax_total',
                    'Total VAT',
                ),

                NumericEntry::number(
                    'quotation.quantity_total',
                    'Total Quantity',
                ),
            ]);
    }
}
