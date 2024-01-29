<?php

namespace App\Filament\Resources\ApplicationsResource\Pages;

use App\Filament\Resources\ApplicationsResource;
use App\Jobs\sendUpdateEmailJob;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditApplications extends EditRecord
{
    protected static string $resource = ApplicationsResource::class;
    public ?int $lastStatus = null;
    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ViewAction::make(),
        ];
    }

    public function mount(int | string $record): void
    {
        parent::mount($record);
        $this->lastStatus = $this->getRecord()->status_id;
    }

    public function afterSave(){
        if ( $this->lastStatus != $this->getRecord()->status_id )
            dispatch(new sendUpdateEmailJob($this->getRecord()->id));
    }
}
