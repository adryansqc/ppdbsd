<?php

namespace App\Filament\Resources\PendaftaranResource\Pages;

use App\Filament\Resources\PendaftaranResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\FileUploadEntry;
use Filament\Actions\Action;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Http;


class ViewPendaftaran extends ViewRecord
{
    protected static string $resource = PendaftaranResource::class;

    protected static string $view = 'filament.resources.pendaftaran-resource.pages.view-pendaftaran';

    protected function getHeaderActions(): array
    {
        return [
            Action::make('terima')
                ->label('Terima Pendaftaran')
                ->color('success')
                ->icon('heroicon-o-check-circle')
                ->requiresConfirmation()
                ->action(function () {
                    $this->record->update([
                        'status_pendaftaran' => 'diterima',
                        'keterangan' => null,
                    ]);
                    $noWa = $this->record->no_hp_ayah ?? $this->record->no_hp_ibu ?? $this->record->no_hp_siswa;

                    if ($noWa) {
                        Http::withHeaders([
                            'Authorization' => env('FONNTE_TOKEN'),
                        ])->asForm()->post('https://api.fonnte.com/send', [
                            'target' => $noWa,
                            'message' => "Assalamu'alaikum,\n\nPendaftaran an. *{$this->record->nama_lengkap}* telah *DITERIMA*. Terima kasih telah mendaftar silahkan login dan lihat petunjuk selanjutnya pada halaman dashboard.",
                            'countryCode' => '62',
                        ]);
                    }

                    Notification::make()
                        ->title('Pendaftaran Diterima')
                        ->success()
                        ->send();
                }),

            Action::make('tolak')
                ->label('Tolak Pendaftaran')
                ->color('danger')
                ->icon('heroicon-o-x-circle')
                ->form([
                    Textarea::make('keterangan')
                        ->label('Keterangan Penolakan')
                        ->required()
                        ->maxLength(255),
                ])
                ->action(function (array $data) {
                    $this->record->update([
                        'status_pendaftaran' => 'ditolak',
                        'keterangan' => $data['keterangan'],
                    ]);

                    $noWa = $this->record->no_hp_ayah ?? $this->record->no_hp_ibu ?? $this->record->no_hp_siswa;

                    if ($noWa) {
                        Http::withHeaders([
                            'Authorization' => env('FONNTE_TOKEN'),
                        ])->asForm()->post('https://api.fonnte.com/send', [
                            'target' => $noWa,
                            'message' => "Assalamu'alaikum,\n\nMohon maaf, pendaftaran an. *{$this->record->nama_lengkap}* telah *DITOLAK*.\n\nAlasan: {$data['keterangan']}",
                            'countryCode' => '62',
                        ]);
                    }

                    Notification::make()
                        ->title('Pendaftaran Ditolak')
                        ->danger()
                        ->send();
                }),
        ];
    }
}
