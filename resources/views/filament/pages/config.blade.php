<x-filament-panels::page>
    <form wire:submit="submit">
        {{ $this->form }}

        <x-filament::button
            type="submit"
            class="mt-6"
        >
            Simpan Pengaturan
        </x-filament::button>
    </form>

</x-filament-panels::page>
