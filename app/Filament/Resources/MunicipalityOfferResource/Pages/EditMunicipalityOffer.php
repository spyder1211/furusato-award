<?php

namespace App\Filament\Resources\MunicipalityOfferResource\Pages;

use App\Filament\Resources\MunicipalityOfferResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMunicipalityOffer extends EditRecord
{
    protected static string $resource = MunicipalityOfferResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
