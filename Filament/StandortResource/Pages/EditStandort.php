<?php

namespace App\Filament\Resources\StandortResource\Pages;

use Filament\Pages\Actions;
use Illuminate\Support\Facades\Auth;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\StandortResource;

class EditStandort extends EditRecord
{
    protected static string $resource = StandortResource::class;

    public function mount($record) :void {
        parent::mount($record);
    
    }


    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeSave(array $data): array{
        return $data;
    }
}
