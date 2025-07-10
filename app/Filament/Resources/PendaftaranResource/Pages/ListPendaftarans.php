<?php

namespace App\Filament\Resources\PendaftaranResource\Pages;

use App\Filament\Resources\PendaftaranResource;
use App\Models\Pendaftaran;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Auth;

class ListPendaftarans extends ListRecords
{
    protected static string $resource = PendaftaranResource::class;

    protected function getHeaderActions(): array
    {
        $user = Auth::user();

        if ($user->hasRole('Super Admin')) {
            return [
                Actions\CreateAction::make(),
            ];
        }

        $pendaftaran = Pendaftaran::where('user_id', $user->id)->first();

        // Jika belum ada pendaftaran, tampilkan tombol untuk membuat pendaftaran
        if (!$pendaftaran) {
            return [
                Actions\CreateAction::make()
                    ->label('Mulai Pendaftaran')
                    ->icon('heroicon-o-document-plus')
                    ->color('primary'),
            ];
        }

        // Jika status pendaftaran 'proses', tampilkan info menunggu
        if ($pendaftaran->status_pendaftaran === 'proses') {
            return [
                Action::make('pending')
                    ->label('Pendaftaran Sedang Diproses')
                    ->icon('heroicon-o-clock')
                    ->disabled()
                    ->color('warning')
                    ->extraAttributes([
                        'title' => 'Pendaftaran Anda sedang dalam tahap verifikasi oleh admin. Mohon tunggu konfirmasi selanjutnya.'
                    ]),
            ];
        }

        // Jika status pendaftaran 'diterima', tampilkan info berhasil
        if ($pendaftaran->status_pendaftaran === 'diterima') {
            return [
                Action::make('accepted')
                    ->label('Pendaftaran Diterima')
                    ->icon('heroicon-o-check-circle')
                    ->disabled()
                    ->color('success')
                    ->extraAttributes([
                        'title' => 'Selamat! Pendaftaran Anda telah diterima. Silakan tunggu informasi selanjutnya dari sekolah.'
                    ]),
                Action::make('download')
                    ->label('Download PDF')
                    ->icon('heroicon-o-document-arrow-down')
                    ->color('info')
                    ->action(function () use ($pendaftaran) {
                        $pendaftaranData = Pendaftaran::with('user')->find($pendaftaran->id);

                        $pdf = Pdf::loadView('pdf.pendaftaran', [
                            'pendaftaran' => $pendaftaranData,
                        ]);
                        $pdf->setPaper('A4', 'portrait');

                        return response()->streamDownload(function () use ($pdf) {
                            echo $pdf->output();
                        }, "pendaftaran-{$pendaftaran->nama_lengkap}-" . date('Y-m-d') . ".pdf");
                    }),

            ];
        }

        // Jika status pendaftaran 'ditolak', tampilkan tombol untuk perbaiki
        if ($pendaftaran->status_pendaftaran === 'ditolak') {
            return [
                Action::make('rejected')
                    ->label('Pendaftaran Ditolak')
                    ->icon('heroicon-o-x-circle')
                    ->disabled()
                    ->color('danger')
                    ->extraAttributes([
                        'title' => $pendaftaran->keterangan ?? 'Pendaftaran Anda ditolak. Silakan perbaiki data dan coba lagi.'
                    ]),
                Actions\CreateAction::make()
                    ->label('Perbaiki Pendaftaran')
                    ->icon('heroicon-o-pencil-square')
                    ->color('warning')
                    ->url(fn() => PendaftaranResource::getUrl('edit', ['record' => $pendaftaran->id]))
                    ->openUrlInNewTab(false),
            ];
        }

        // Default fallback
        return [
            Action::make('unknown_status')
                ->label('Status Tidak Diketahui')
                ->icon('heroicon-o-question-mark-circle')
                ->disabled()
                ->color('gray'),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            // Bisa tambahkan widget di sini jika diperlukan
        ];
    }

    public function getTitle(): string
    {
        $user = Auth::user();

        if ($user->hasRole('Super Admin')) {
            return 'Kelola Pendaftaran';
        }

        $pendaftaran = Pendaftaran::where('user_id', $user->id)->first();

        if (!$pendaftaran) {
            return 'Pendaftaran PPDB';
        }

        return match ($pendaftaran->status_pendaftaran) {
            'proses' => 'Pendaftaran - Sedang Diproses',
            'diterima' => 'Pendaftaran - Diterima',
            'ditolak' => 'Pendaftaran - Ditolak',
            default => 'Pendaftaran PPDB'
        };
    }
}
