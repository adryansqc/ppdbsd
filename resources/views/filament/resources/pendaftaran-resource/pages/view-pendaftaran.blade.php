<x-filament-panels::page>
    <div class="space-y-6">
        <!-- Header dengan Status -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <div class="flex justify-between items-start">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                        {{ $record->nama_lengkap }}
                    </h2>
                    <p class="text-gray-600 dark:text-gray-400 mt-1">
                        Pendaftaran Siswa Baru - ID: {{ $record->id }}
                    </p>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                        Didaftarkan pada: {{ $record->created_at->format('d F Y H:i') }}
                    </p>
                </div>
                <div class="text-right">
                    @php
                        $statusColor = match($record->status_pendaftaran) {
                            'diterima' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300',
                            'ditolak' => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300',
                            'proses' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300',
                            default => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300'
                        };
                    @endphp
                    <span class="px-3 py-1 rounded-full text-sm font-medium {{ $statusColor }}">
                        {{ ucfirst($record->status_pendaftaran) }}
                    </span>
                    @if($record->keterangan)
                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-2 max-w-xs">
                            <strong>Keterangan:</strong> {{ $record->keterangan }}
                        </p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Data Pribadi Siswa -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Data Pribadi Siswa
                </h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Lengkap</label>
                        <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $record->nama_lengkap }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jenis Kelamin</label>
                        <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ ucfirst($record->jenis_kelamin) }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tempat Lahir</label>
                        <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $record->tempat_lahir }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Lahir</label>
                        <p class="mt-1 text-sm text-gray-900 dark:text-white">
                            @if($record->tanggal_lahir instanceof \Carbon\Carbon)
                                {{ $record->tanggal_lahir->format('d F Y') }}
                            @elseif($record->tanggal_lahir)
                                {{ \Carbon\Carbon::parse($record->tanggal_lahir)->format('d F Y') }}
                            @else
                                -
                            @endif
                        </p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Agama</label>
                        <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $record->agama }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Anak Ke</label>
                        <p class="mt-1 text-sm text-gray-900 dark:text-white">
                            {{ $record->anak_ke }} dari {{ $record->jumlah_saudara }} bersaudara
                        </p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status dalam Keluarga</label>
                        <p class="mt-1 text-sm text-gray-900 dark:text-white">
                            {{ ucfirst($record->status_dalam_keluarga) }}
                        </p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">No HP Siswa</label>
                        <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $record->no_hp_siswa ?: '-' }}</p>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Alamat</label>
                        <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $record->alamat }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Data Asal Sekolah -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Data Asal Sekolah
                </h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Asal Sekolah</label>
                        <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $record->asal_sekolah }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Alamat Sekolah</label>
                        <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $record->alamat_sekolah ?: '-' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Data Orang Tua -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Data Orang Tua / Wali
                </h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Data Ayah -->
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                        <h4 class="font-medium text-gray-900 dark:text-white mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Data Ayah
                        </h4>
                        <div class="space-y-3">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama</label>
                                <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $record->nama_ayah }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Alamat</label>
                                <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $record->alamat_ayah ?: '-' }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">No HP</label>
                                <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $record->no_hp_ayah ?: '-' }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Pekerjaan</label>
                                <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $record->pekerjaan_ayah ?: '-' }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Pendidikan Terakhir</label>
                                <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $record->pendidikan_ayah ?: '-' }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Penghasilan</label>
                                <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $record->penghasilan_ayah ?: '-' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Data Ibu -->
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                        <h4 class="font-medium text-gray-900 dark:text-white mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Data Ibu
                        </h4>
                        <div class="space-y-3">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama</label>
                                <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $record->nama_ibu }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Alamat</label>
                                <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $record->alamat_ibu ?: '-' }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">No HP</label>
                                <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $record->no_hp_ibu ?: '-' }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Pekerjaan</label>
                                <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $record->pekerjaan_ibu ?: '-' }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Pendidikan Terakhir</label>
                                <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $record->pendidikan_ibu ?: '-' }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Penghasilan</label>
                                <p class="mt-1 text-sm text-gray-900 dark:text-white">{{ $record->penghasilan_ibu ?: '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dokumen Pendukung -->
        <!-- Dokumen Pendukung -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                    <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Dokumen Pendukung
                </h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @php
                        $documents = [
                            'pas_foto' => [
                                'label' => 'Pas Foto',
                                'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'
                            ],
                            'akta' => [
                                'label' => 'Akta Kelahiran',
                                'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'
                            ],
                            'kk' => [
                                'label' => 'Kartu Keluarga',
                                'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z'
                            ],
                            'ktp' => [
                                'label' => 'KTP Orang Tua',
                                'icon' => 'M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2'
                            ],
                            'ijazah_tk' => [
                                'label' => 'Ijazah TK',
                                'icon' => 'M12 14l9-5-9-5-9 5 9 5z M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z'
                            ]
                        ];
                    @endphp

                    @foreach($documents as $field => $document)
                        <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4 hover:shadow-md transition-shadow">
                            <div class="flex items-center mb-3">
                                <svg class="w-5 h-5 mr-2 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $document['icon'] }}"></path>
                                </svg>
                                <h4 class="font-medium text-gray-900 dark:text-white">{{ $document['label'] }}</h4>
                            </div>

                            @if($record->$field)
                                <div class="space-y-3">
                                    <div class="relative group">
                                        <img src="{{ Storage::url($record->$field) }}"
                                             alt="{{ $document['label'] }}"
                                             class="w-full h-32 object-cover rounded border cursor-pointer hover:opacity-75 transition-opacity"
                                             onclick="openDocumentModal('{{ Storage::url($record->$field) }}', '{{ $document['label'] }}')">
                                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-all rounded flex items-center justify-center">
                                            <svg class="w-8 h-8 text-white opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <button type="button"
                                            onclick="openDocumentModal('{{ Storage::url($record->$field) }}', '{{ $document['label'] }}')"
                                            class="inline-flex items-center text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 transition-colors">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        Lihat Dokumen
                                    </button>
                                </div>
                            @else
                                <div class="flex items-center justify-center h-32 bg-gray-100 dark:bg-gray-600 rounded border-2 border-dashed border-gray-300 dark:border-gray-500">
                                    <div class="text-center">
                                        <svg class="w-8 h-8 mx-auto text-gray-400 dark:text-gray-500 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                        </svg>
                                        <p class="text-sm text-gray-500 dark:text-gray-400 italic">Belum diupload</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>


        <!-- Enhanced Modal untuk Dokumen -->
        <div id="documentModal" class="fixed inset-0 bg-black bg-opacity-60 backdrop-blur-sm overflow-y-auto h-full w-full z-50 hidden transition-all duration-300 ease-in-out">
            <div class="flex items-center justify-center min-h-screen px-4 py-8">
                <div id="modalContent" class="relative bg-white dark:bg-gray-800 rounded-2xl shadow-2xl w-full max-w-4xl transform transition-all duration-300 ease-in-out scale-95 opacity-0">
                    <!-- Modal Header -->
                    <div class="flex items-center justify-between p-6 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-750 rounded-t-2xl">
                        <div class="flex items-center space-x-3">
                            <div class="flex-shrink-0 w-10 h-10 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 id="modalTitle" class="text-xl font-bold text-gray-900 dark:text-white">
                                    Dokumen
                                </h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Klik gambar untuk memperbesar</p>
                            </div>
                        </div>
                        <button type="button"
                                onclick="closeDocumentModal()"
                                class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 bg-transparent hover:bg-gray-100 dark:hover:bg-gray-700 rounded-full p-2 transition-all duration-200 ease-in-out transform hover:scale-110">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Modal Body -->
                    <div class="p-6">
                        <div class="relative">
                            <!-- Loading Spinner -->
                            <div id="imageLoader" class="absolute inset-0 flex items-center justify-center bg-gray-100 dark:bg-gray-700 rounded-lg">
                                <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600"></div>
                            </div>

                            <!-- Image Container -->
                            <div class="text-center relative overflow-hidden rounded-lg bg-gray-50 dark:bg-gray-700">
                                <img id="modalImage"
                                     src=""
                                     alt="Dokumen"
                                     class="max-w-full max-h-[70vh] mx-auto rounded-lg shadow-lg cursor-zoom-in transition-transform duration-300 ease-in-out hover:scale-105"
                                     style="display: none;"
                                     onload="hideImageLoader()"
                                     onclick="toggleImageZoom(this)">
                            </div>

                            <!-- Zoom Controls -->
                            <div id="zoomControls" class="absolute top-4 right-4 flex space-x-2 opacity-0 transition-opacity duration-300">
                                <button onclick="zoomImage('in')" class="bg-black bg-opacity-50 text-white p-2 rounded-full hover:bg-opacity-70 transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                </button>
                                <button onclick="zoomImage('out')" class="bg-black bg-opacity-50 text-white p-2 rounded-full hover:bg-opacity-70 transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 12H6"></path>
                                    </svg>
                                </button>
                                <button onclick="resetZoom()" class="bg-black bg-opacity-50 text-white p-2 rounded-full hover:bg-opacity-70 transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <div class="flex items-center justify-between p-6 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-750 rounded-b-2xl">
                        <div class="text-sm text-gray-500 dark:text-gray-400">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Gunakan scroll atau tombol zoom untuk memperbesar
                            </span>
                        </div>
                        <div class="flex space-x-3">
                            <a id="downloadLink"
                               href=""
                               download
                               class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-medium rounded-lg text-sm transition-all duration-200 ease-in-out transform hover:scale-105 shadow-lg hover:shadow-xl">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                Download
                            </a>
                            <button type="button"
                                    onclick="closeDocumentModal()"
                                    class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 dark:bg-gray-600 dark:hover:bg-gray-500 text-gray-700 dark:text-gray-200 font-medium rounded-lg text-sm transition-all duration-200 ease-in-out transform hover:scale-105">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                Tutup
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Informasi Sistem -->
        <div class="bg-gray-50 dark:bg-gray-700 rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                Informasi Sistem
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                <div>
                    <label class="block font-medium text-gray-700 dark:text-gray-300">ID Pendaftaran</label>
                    <p class="text-gray-900 dark:text-white">{{ $record->id }}</p>
                </div>
                <div>
                    <label class="block font-medium text-gray-700 dark:text-gray-300">Tanggal Pendaftaran</label>
                    <p class="text-gray-900 dark:text-white">{{ $record->created_at->format('d F Y H:i') }}</p>
                </div>
                <div>
                    <label class="block font-medium text-gray-700 dark:text-gray-300">Terakhir Diupdate</label>
                    <p class="text-gray-900 dark:text-white">{{ $record->updated_at->format('d F Y H:i') }}</p>
                </div>
            </div>
        </div>
    </div>
    <script>
        let currentZoom = 1;
        let isZoomed = false;

        function openDocumentModal(imageUrl, documentTitle) {
            const modal = document.getElementById('documentModal');
            const modalContent = document.getElementById('modalContent');
            const modalTitle = document.getElementById('modalTitle');
            const modalImage = document.getElementById('modalImage');
            const downloadLink = document.getElementById('downloadLink');
            const imageLoader = document.getElementById('imageLoader');
            const zoomControls = document.getElementById('zoomControls');

            // Reset zoom
            currentZoom = 1;
            isZoomed = false;

            // Set content
            modalTitle.textContent = documentTitle;
            modalImage.src = imageUrl;
            modalImage.alt = documentTitle;
            downloadLink.href = imageUrl;

            // Show loader
            imageLoader.style.display = 'flex';
            modalImage.style.display = 'none';
            modalImage.style.transform = 'scale(1)';

            // Show modal with animation
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';

            // Trigger animation
            setTimeout(() => {
                modalContent.classList.remove('scale-95', 'opacity-0');
                modalContent.classList.add('scale-100', 'opacity-100');
            }, 10);

            // Show zoom controls on hover
            modalImage.addEventListener('mouseenter', () => {
                zoomControls.classList.remove('opacity-0');
                zoomControls.classList.add('opacity-100');
            });

            modalImage.addEventListener('mouseleave', () => {
                if (!isZoomed) {
                    zoomControls.classList.remove('opacity-100');
                    zoomControls.classList.add('opacity-0');
                }
            });
        }

        function closeDocumentModal() {
            const modal = document.getElementById('documentModal');
            const modalContent = document.getElementById('modalContent');

            // Animate out
            modalContent.classList.remove('scale-100', 'opacity-100');
            modalContent.classList.add('scale-95', 'opacity-0');

            setTimeout(() => {
                modal.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }, 300);
        }

        function hideImageLoader() {
            const imageLoader = document.getElementById('imageLoader');
            const modalImage = document.getElementById('modalImage');

            imageLoader.style.display = 'none';
            modalImage.style.display = 'block';
        }

        function toggleImageZoom(img) {
            if (isZoomed) {
                resetZoom();
            } else {
                zoomImage('in');
            }
        }

        function zoomImage(direction) {
            const modalImage = document.getElementById('modalImage');
            const zoomControls = document.getElementById('zoomControls');

            if (direction === 'in') {
                currentZoom = Math.min(currentZoom * 1.5, 3);
                isZoomed = true;
                modalImage.style.cursor = 'zoom-out';
            } else if (direction === 'out') {
                currentZoom = Math.max(currentZoom / 1.5, 1);
                if (currentZoom === 1) {
                    isZoomed = false;
                    modalImage.style.cursor = 'zoom-in';
                }
            }

            modalImage.style.transform = `scale(${currentZoom})`;

            // Keep zoom controls visible when zoomed
            if (isZoomed) {
                zoomControls.classList.remove('opacity-0');
                zoomControls.classList.add('opacity-100');
            }
        }

        function resetZoom() {
            const modalImage = document.getElementById('modalImage');
            const zoomControls = document.getElementById('zoomControls');

            currentZoom = 1;
            isZoomed = false;
            modalImage.style.transform = 'scale(1)';
            modalImage.style.cursor = 'zoom-in';

            zoomControls.classList.remove('opacity-100');
            zoomControls.classList.add('opacity-0');
        }

        // Close modal when clicking outside
        document.getElementById('documentModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeDocumentModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeDocumentModal();
            }
        });

        // Zoom with mouse wheel
        document.getElementById('modalImage').addEventListener('wheel', function(e) {
            e.preventDefault();
            if (e.deltaY < 0) {
                zoomImage('in');
            } else {
                zoomImage('out');
            }
        });
    </script>
</x-filament-panels::page>