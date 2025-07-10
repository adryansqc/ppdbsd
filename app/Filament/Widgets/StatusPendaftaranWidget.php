<?php

namespace App\Filament\Widgets;

use App\Models\Pendaftaran;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class StatusPendaftaranWidget extends BaseWidget
{
    protected static string $view = 'filament.widgets.status-pendaftaran-widget';

    protected int | string | array $columnSpan = 'full';

    protected static ?int $sort = 1;

    protected function getViewData(): array
    {
        $user = Auth::user();
        $pendaftaran = Pendaftaran::where('user_id', $user->id)->first();

        return [
            'pendaftaran' => $pendaftaran,
            'user' => $user,
            'status_info' => $this->getStatusInfo($pendaftaran),
            'progress_percentage' => $this->getProgressPercentage($pendaftaran),
            'next_steps' => $this->getNextSteps($pendaftaran)
        ];
    }

    private function getStatusInfo($pendaftaran)
    {
        if (!$pendaftaran) {
            return null;
        }

        switch ($pendaftaran->status_pendaftaran) {
            case 'proses':
                return [
                    'status' => 'proses',
                    'title' => 'Sedang Diproses',
                    'description' => 'Pendaftaran Anda sedang dalam tahap verifikasi oleh admin',
                    'color' => 'warning',
                    'icon' => 'heroicon-o-clock'
                ];
            case 'diterima':
                return [
                    'status' => 'diterima',
                    'title' => 'Diterima',
                    'description' => 'Selamat! Pendaftaran Anda telah diterima',
                    'color' => 'success',
                    'icon' => 'heroicon-o-check-circle'
                ];
            case 'ditolak':
                return [
                    'status' => 'ditolak',
                    'title' => 'Ditolak',
                    'description' => 'Pendaftaran Anda ditolak. Silakan periksa keterangan di bawah',
                    'color' => 'danger',
                    'icon' => 'heroicon-o-x-circle'
                ];
            default:
                return [
                    'status' => 'unknown',
                    'title' => 'Status Tidak Diketahui',
                    'description' => 'Terjadi kesalahan dalam menentukan status',
                    'color' => 'gray',
                    'icon' => 'heroicon-o-question-mark-circle'
                ];
        }
    }

    private function getProgressPercentage($pendaftaran)
    {
        if (!$pendaftaran) {
            return 0;
        }

        $totalFields = 8; // Total field dokumen yang harus diisi
        $filledFields = 0;

        // Cek field yang sudah diisi
        $requiredFields = ['pas_foto', 'akta', 'kk', 'ktp', 'ijazah_tk'];
        foreach ($requiredFields as $field) {
            if (!empty($pendaftaran->$field)) {
                $filledFields++;
            }
        }

        // Cek data pribadi (anggap sudah lengkap jika ada nama_lengkap)
        if (!empty($pendaftaran->nama_lengkap)) {
            $filledFields += 2; // Data pribadi + data orang tua
        }

        // Cek data sekolah
        if (!empty($pendaftaran->asal_sekolah)) {
            $filledFields += 1;
        }

        return min(100, ($filledFields / $totalFields) * 100);
    }

    private function getNextSteps($pendaftaran)
    {
        if (!$pendaftaran) {
            return [
                'Lengkapi formulir pendaftaran',
                'Upload dokumen yang diperlukan',
                'Submit pendaftaran untuk verifikasi'
            ];
        }

        switch ($pendaftaran->status_pendaftaran) {
            case 'proses':
                return [
                    'Menunggu verifikasi admin',
                    'Pastikan nomor HP aktif untuk dihubungi',
                    'Periksa email secara berkala'
                ];
            case 'diterima':
                return [
                    'Download berkas bukti diterima pada halaman pendaftaran',
                    'Siapkan berkas asli untuk daftar ulang',
                    'Datang ke sekolah sesuai jadwal yang ditentukan',
                    'Bawa bukti pembayaran jika diperlukan'
                ];
            case 'ditolak':
                return [
                    'Periksa keterangan penolakan',
                    'Perbaiki dokumen yang bermasalah',
                    'Hubungi admin jika ada pertanyaan'
                ];
            default:
                return [];
        }
    }
}
