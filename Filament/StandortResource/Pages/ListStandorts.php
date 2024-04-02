<?php

namespace App\Filament\Resources\StandortResource\Pages;

use App\Filament\Resources\StandortResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStandorts extends ListRecords
{
    protected static string $resource = StandortResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
