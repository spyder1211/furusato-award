<?php

namespace App\Filament\Resources\CompanyOfferResource\Pages;

use App\Filament\Resources\CompanyOfferResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCompanyOffers extends ListRecords
{
    protected static string $resource = CompanyOfferResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
