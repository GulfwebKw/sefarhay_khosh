<?php

namespace App\Filament\Resources\ContactsResource\Pages;

use App\Filament\Resources\ContactsResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewContacts extends ViewRecord
{
    protected static string $resource = ContactsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('visit')
                ->label('Guest View')
                ->icon('heroicon-m-arrow-top-right-on-square')
                ->openUrlInNewTab()
                ->color('info')
                ->url(function(Application $application) {
                    return  route('application.show', ['uuid' => $application->uuid]);
                }),
        ];
    }

    public function mount(int | string $record): void
    {
        parent::mount($record);

        $this->record->read();
    }
}
