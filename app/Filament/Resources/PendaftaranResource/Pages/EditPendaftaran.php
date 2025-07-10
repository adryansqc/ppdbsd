<?php

namespace App\Filament\Resources\PendaftaranResource\Pages;

use App\Filament\Resources\PendaftaranResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;
use Illuminate\Http\RedirectResponse;

class EditPendaftaran extends EditRecord
{
    protected static string $resource = PendaftaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    // Override mount method to check status
    public function mount(int | string $record): void
    {
        parent::mount($record);


        if (in_array($this->record->status_pendaftaran, ['proses', 'diterima'])) {
            Notification::make()
                ->title('Anda tidak bisa mengubah formulir pendaftaran dengan status ini.')
                ->warning()
                ->send();
            $this->redirect(PendaftaranResource::getUrl('index'));
        }
    }
}
