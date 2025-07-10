<?php

namespace App\Filament\Resources\UserVerificationResource\Pages;

use App\Filament\Resources\UserVerificationResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUserVerification extends CreateRecord
{
    protected static string $resource = UserVerificationResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
