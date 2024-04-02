<?php

namespace App\Filament\Resources\SsoUserResource\Pages;

use App\Filament\Resources\SsoUserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSsoUser extends EditRecord
{
    protected static string $resource = SsoUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
