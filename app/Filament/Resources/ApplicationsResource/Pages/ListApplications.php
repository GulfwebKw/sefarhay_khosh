<?php

namespace App\Filament\Resources\ApplicationsResource\Pages;

use App\Filament\Resources\ApplicationsResource;
use App\Models\Status;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListApplications extends ListRecords
{
    protected static string $resource = ApplicationsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }


    public function getTabs(): array
    {
        $data = [
            '-1' => ListRecords\Tab::make('All')
        ];

        foreach ( Status::query()->orderBy('ordering')->get() as $status)
            $data[$status->id] = ListRecords\Tab::make($status->title_en)->query(fn ($query) => $query->where('status_id', $status->id));
        return $data ;
    }
}
