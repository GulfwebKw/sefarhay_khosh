<?php

namespace App\Filament\Resources\Setting\StatusResource\Pages;

use App\Filament\Resources\Setting\StatusResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStatuses extends ListRecords
{
    protected static string $resource = StatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
