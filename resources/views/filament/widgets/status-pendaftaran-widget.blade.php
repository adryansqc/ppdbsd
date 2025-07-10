<x-filament-widgets::widget>
    @php
        $data = $this->getViewData();
        $pendaftaran = $data['pendaftaran'] ?? null;
        $statusInfo = $data['status_info'] ?? null;
        $progressPercentage = $data['progress_percentage'] ?? 0;
        $nextSteps = $data['next_steps'] ?? [];
    @endphp
    @if($statusInfo)
    <x-filament::section>
        <x-slot name="heading">
            <div class="flex items-center space-x-2">
                <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <span class="text-lg font-semibold">Status Pendaftaran PPDB</span>
            </div>
        </x-slot>


            <div class="space-y-6">
                <!-- Status Card -->
                <div class="bg-gradient-to-r from-{{ $statusInfo['color'] }}-50 to-{{ $statusInfo['color'] }}-100 dark:from-{{ $statusInfo['color'] }}-900/20 dark:to-{{ $statusInfo['color'] }}-800/20 rounded-xl p-6 border border-{{ $statusInfo['color'] }}-200 dark:border-{{ $statusInfo['color'] }}-800">
                    <div class="flex items-start justify-between">
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-{{ $statusInfo['color'] }}-500 rounded-full flex items-center justify-center">
                                    @if(isset($statusInfo['icon']))
                                        @if($statusInfo['icon'] === 'heroicon-o-clock')
                                            <x-heroicon-o-clock class="w-6 h-6 text-white" />
                                        @elseif($statusInfo['icon'] === 'heroicon-o-check-circle')
                                            <x-heroicon-o-check-circle class="w-6 h-6 text-white" />
                                        @elseif($statusInfo['icon'] === 'heroicon-o-x-circle')
                                            <x-heroicon-o-x-circle class="w-6 h-6 text-white" />
                                        @elseif($statusInfo['icon'] === 'heroicon-o-document-plus')
                                            <x-heroicon-o-document-plus class="w-6 h-6 text-white" />
                                        @else
                                            <x-heroicon-o-question-mark-circle class="w-6 h-6 text-white" />
                                        @endif
                                    @endif
                                </div>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-{{ $statusInfo['color'] }}-800 dark:text-{{ $statusInfo['color'] }}-200">
                                    {{ $statusInfo['title'] ?? 'Status Tidak Diketahui' }}
                                </h3>
                                <p class="text-{{ $statusInfo['color'] }}-600 dark:text-{{ $statusInfo['color'] }}-300 mt-1">
                                    {{ $statusInfo['description'] ?? 'Tidak ada deskripsi' }}
                                </p>
                            </div>
                        </div>

                        @if($pendaftaran)
                            <div class="text-right">
                                <div class="text-sm text-gray-500 dark:text-gray-400">
                                    Tanggal Daftar
                                </div>
                                <div class="font-medium text-gray-900 dark:text-gray-100">
                                    {{ $pendaftaran->created_at->format('d M Y') }}
                                </div>
                            </div>
                        @endif
                    </div>

                    @if($pendaftaran && $pendaftaran->keterangan)
                        <div class="mt-4 p-4 bg-white dark:bg-gray-800 rounded-lg border border-{{ $statusInfo['color'] }}-200 dark:border-{{ $statusInfo['color'] }}-700">
                            <div class="flex items-start space-x-2">
                                <svg class="w-5 h-5 text-{{ $statusInfo['color'] }}-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <div>
                                    <h4 class="font-medium text-gray-900 dark:text-gray-100">Keterangan:</h4>
                                    <p class="text-gray-700 dark:text-gray-300 mt-1">{{ $pendaftaran->keterangan }}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                @if($pendaftaran)
                    <!-- Progress Bar -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700">
                        <div class="flex items-center justify-between mb-4">
                            <h4 class="font-semibold text-gray-900 dark:text-gray-100">Kelengkapan Data</h4>
                            <span class="text-sm font-medium text-gray-600 dark:text-gray-400">
                                {{ number_format($progressPercentage, 0) }}%
                            </span>
                        </div>

                        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-3 mb-4">
                            <div class="bg-gradient-to-r from-blue-500 to-blue-600 h-3 rounded-full transition-all duration-500 ease-out"
                                 style="width: {{ $progressPercentage }}%"></div>
                        </div>

                        <div class="grid grid-cols-2 md:grid-cols-5 gap-4 text-sm">
                            @php
                                $documents = [
                                    'pas_foto' => 'Pas Foto',
                                    'akta' => 'Akta Kelahiran',
                                    'kk' => 'Kartu Keluarga',
                                    'ktp' => 'KTP Orang Tua',
                                    'ijazah_tk' => 'Ijazah TK'
                                ];
                            @endphp

                            @foreach($documents as $field => $label)
                                <div class="flex items-center space-x-2">
                                    @if(!empty($pendaftaran->$field))
                                        <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <span class="text-green-700 dark:text-green-400">{{ $label }}</span>
                                    @else
                                        <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                        <span class="text-red-700 dark:text-red-400">{{ $label }}</span>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Next Steps -->
                @if(!empty($nextSteps))
                    <div class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700">
                        <h4 class="font-semibold text-gray-900 dark:text-gray-100 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                            Langkah Selanjutnya
                        </h4>

                        <div class="space-y-3">
                            @foreach($nextSteps as $index => $step)
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0 w-6 h-6 bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-white rounded-full flex items-center justify-center text-sm font-medium">
                                        {{ $index + 1 }}
                                    </div>
                                    <p class="text-gray-700 dark:text-white">{{ $step }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Action Buttons -->
                <div class="flex flex-wrap gap-3">
                    @if(!$pendaftaran)
                        <a href="{{ route('filament.admin.resources.pendaftarans.create') }}"
                           class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Mulai Pendaftaran
                        </a>
                    @else
                    @endif

                    <a href="mailto:admin@sekolah.com"
                       class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        Hubungi Admin
                    </a>
                </div>
            </div>
        </x-filament::section>
        @else

        @endif
</x-filament-widgets::widget>