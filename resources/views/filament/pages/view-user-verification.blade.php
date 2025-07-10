<x-filament::page>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2">
            <x-filament::section>
                <x-slot name="heading">
                    Informasi Akun dan Verifikasi
                </x-slot>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Pemilik Akun</p>
                        <p class="text-gray-950 dark:text-white font-semibold">{{ $record->user->name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Nama Lengkap</p>
                        <p class="text-gray-950 dark:text-white font-semibold">{{ $record->nama_lengkap }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Nama Orang Tua</p>
                        <p class="text-gray-950 dark:text-white font-semibold">{{ $record->nama_ortu }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Status Verifikasi</p>
                        <p class="text-gray-950 dark:text-white font-semibold">{{ $record->status }}</p>
                    </div>
                    @if ($record->keterangan)
                        <div class="md:col-span-2">
                            <p class="text-sm text-gray-500 dark:text-gray-400">Keterangan (Alasan Penolakan)</p>
                            <p class="text-gray-950 dark:text-white">{{ $record->keterangan }}</p>
                        </div>
                    @endif
                </div>
            </x-filament::section>
        </div>

        <div class="lg:col-span-1">
            <x-filament::section>
                <x-slot name="heading">
                    Bukti Pembayaran
                </x-slot>

                @if ($record->bukti_pembayaran)
                    <a href="{{ Storage::url($record->bukti_pembayaran) }}" target="_blank" rel="noopener noreferrer">
                        <img src="{{ Storage::url($record->bukti_pembayaran) }}"
                             alt="Bukti Pembayaran"
                             class="rounded-lg shadow-md w-full object-contain max-h-80" />
                    </a>
                @else
                    <p class="text-sm text-gray-500 dark:text-gray-400">Belum ada bukti pembayaran diunggah.</p>
                @endif
            </x-filament::section>
        </div>
    </div>
</x-filament::page>
