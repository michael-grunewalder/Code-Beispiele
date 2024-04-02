<?php

namespace App\Filament\Resources\SsoUserResource\Pages;

use App\Filament\Resources\SsoUserResource;
use App\Models\Filament\SsoUser;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Keycloak\Admin\KeycloakClient;

class CreateSsoUser extends CreateRecord
{
    protected static string $resource = SsoUserResource::class;
    protected $uuid;

    protected function getRedirectUrl(): string
    {
        return '/admin/management/users-roles/user-editor/' . $this->uuid;
    }

    protected function handleRecordCreation(array $data): Model
    {
        //first we add the firma_id to the data bundle
        $data['firma_id'] = auth()->user()->firma_id;

        //then we create the SSO User
        $this->uuid = $this->createSSOUser($data);
        return new SsoUser();//$model;
    }

    private function createSSOUser($data)
    {
        $data['firma_id'] = auth()->user()->firma_id;
        return SsoUser::newUser($data);

    }

}
