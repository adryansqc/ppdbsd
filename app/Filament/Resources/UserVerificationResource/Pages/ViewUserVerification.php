<?php

namespace App\Filament\Resources\UserVerificationResource\Pages;

use App\Filament\Resources\UserVerificationResource;
use Filament\Actions;
use Filament\Pages\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Filament\Notifications\Notification;
use Filament\Forms\Components\Textarea;
use Illuminate\Support\Facades\Http;

class ViewUserVerification extends ViewRecord
{
    protected static string $resource = UserVerificationResource::class;

    protected static string $view = 'filament.pages.view-user-verification';

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('terima')
                ->label('Terima')
                ->color('success')
                ->icon('heroicon-o-check-circle')
                ->requiresConfirmation()
                ->visible(fn() => $this->record->status === 'pending' || $this->record->status === 'ditolak')
                ->action(function () {
                    $this->record->update([
                        'status' => 'diterima',
                        'keterangan' => null,
                    ]);

                    Http::withHeaders([
                        'Authorization' => env('FONNTE_TOKEN'),
                    ])->asForm()->post('https://api.fonnte.com/send', [
                        'target' => $this->record->no_wa,
                        'message' => "Assalamu'alaikum {$this->record->nama_lengkap},\n\nVerifikasi akun kamu telah *DITERIMA*. Silahkan login dan lanjutkan pendaftaran.",
                        'countryCode' => '62',
                    ]);

                    Notification::make()
                        ->title('Verifikasi berhasil diterima')
                        ->success()
                        ->send();

                    $this->redirect($this->getResource()::getUrl('index'));
                }),

            Actions\Action::make('tolak')
                ->label('Tolak')
                ->color('danger')
                ->icon('heroicon-o-x-circle')
                ->visible(fn() => $this->record->status === 'pending' || $this->record->status === 'diterima')
                ->form([
                    Textarea::make('keterangan')
                        ->label('Alasan Penolakan')
                        ->required()
                ])
                ->action(function (array $data) {
                    $this->record->update([
                        'status' => 'ditolak',
                        'keterangan' => $data['keterangan'],
                    ]);


                    Http::withHeaders([
                        'Authorization' => env('FONNTE_TOKEN'),
                    ])->asForm()->post('https://api.fonnte.com/send', [
                        'target' => $this->record->no_wa,
                        'message' => "Assalamu'alaikum {$this->record->nama_lengkap},\n\nMaaf, verifikasi kamu *DITOLAK*.\n\nAlasan: {$data['keterangan']} silahkan diperbaiki",
                        'countryCode' => '62',
                    ]);

                    Notification::make()
                        ->title('Verifikasi telah ditolak')
                        ->danger()
                        ->send();

                    $this->redirect($this->getResource()::getUrl('index'));
                }),
        ];
    }

    protected function getViewData(): array
    {
        return [
            'record' => $this->record,
        ];
    }
}
