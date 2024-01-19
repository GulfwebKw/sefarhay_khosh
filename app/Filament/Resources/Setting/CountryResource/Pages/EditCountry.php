<?php

namespace App\Filament\Resources\Setting\CountryResource\Pages;

use App\Filament\Resources\Setting\CountryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCountry extends EditRecord
{
    protected static string $resource = CountryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
