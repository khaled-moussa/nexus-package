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
                    placeholder: '—'
                ),

                NumericEntry::money(
                    name: 'quotation.discount_total',
                    label: 'Total Sale',
                    placeholder: '—'
                ),

                NumericEntry::money(
                    name: 'quotation.tax_total',
                    label: 'Total VAT',
                    placeholder: '—'
                ),

                NumericEntry::number(
                    name: 'quotation.quantity_total',
                    label: 'Total Quantity',
                    placeholder: '—'
                ),
            ]);
    }
}
