<?php

namespace App\Filament\Resources\MunicipalityOfferResource\Pages;

use App\Filament\Resources\MunicipalityOfferResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMunicipalityOffers extends ListRecords
{
    protected static string $resource = MunicipalityOfferResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
