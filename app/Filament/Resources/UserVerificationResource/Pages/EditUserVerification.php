<?php

namespace App\Filament\Resources\UserVerificationResource\Pages;

use App\Filament\Resources\UserVerificationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model; // Import Model

class EditUserVerification extends EditRecord
{
    protected static string $resource = UserVerificationResource::class;

    public function getTitle(): string|Htmlable
    {
        return 'Verifikasi dan Pembayaran';
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $data['status'] = 'pending';
        $record->update($data);
        return $record;
    }
}
