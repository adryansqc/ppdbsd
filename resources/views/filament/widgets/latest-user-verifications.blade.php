<div>
    @if ($user && !$user->hasRole('Super Admin'))
        <x-filament::card>
            @if ($verification)
                @if ($verification->status === 'pending')
                    <p class="text-warning-600">Halo {{ $user->nama_lengkap }}, data verifikasi Anda sedang dalam proses peninjauan. Mohon tunggu konfirmasi selanjutnya.</p>
                @elseif ($verification->status === 'diterima')
                    {{-- Changed route() helper to PendaftaranResource::getUrl() --}}
                    <p class="text-success-600">Selamat {{ $user->nama_lengkap }}, akun Anda telah berhasil diverifikasi! Silahkan Lanjutkan <a href="{{ \App\Filament\Resources\PendaftaranResource::getUrl('index') }}" class="text-primary-600 hover:underline">Pendaftaran</a></p>
                @elseif ($verification->status === 'ditolak')
                     <p class="text-danger-600">Halo {{ $user->nama_lengkap }}, data verifikasi Anda ditolak. Keterangan: {{ $verification->keterangan ?? '-' }}. Mohon perbaiki data Anda.</p>
                @else
                     <p class="text-secondary-600">Halo {{ $user->nama_lengkap }}, status verifikasi Anda: {{ $verification->status }}.</p>
                @endif
            @else
                <p class="text-info-600">Halo {{ $user->nama_lengkap }}, Anda belum mengajukan verifikasi. Silakan lengkapi data verifikasi Anda.</p>
            @endif
        </x-filament::card>
    @endif
</div>