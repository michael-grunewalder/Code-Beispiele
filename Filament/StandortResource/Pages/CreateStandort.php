<?php

namespace App\Filament\Resources\StandortResource\Pages;

use Filament\Pages\Actions;
use Illuminate\Support\Facades\Auth;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\StandortResource;

class CreateStandort extends CreateRecord
{
    protected static string $resource = StandortResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        //die Filiale muss einem kunden gehoeren und der Kunde muss der angemeldete benutzer sein:
        $data['kunde_id']   =   Auth::user()->kunde_id;
        return $data;
    }
}
