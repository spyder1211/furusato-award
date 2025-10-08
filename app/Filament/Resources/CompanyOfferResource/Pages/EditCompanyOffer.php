<?php

namespace App\Filament\Resources\CompanyOfferResource\Pages;

use App\Filament\Resources\CompanyOfferResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCompanyOffer extends EditRecord
{
    protected static string $resource = CompanyOfferResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
