<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Cash Inflow') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <form method="POST" action="{{ route('cash-inflow.store') }}">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <x-input-label for="tanggal" :value="__('Tanggal')" />
                            <x-text-input id="tanggal" class="block mt-1 w-full" type="date" name="tanggal" :value="old('tanggal')" required />
                            <x-input-error :messages="$errors->get('tanggal')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="deskripsi" :value="__('Deskripsi')" />
                            <x-text-input id="deskripsi" class="block mt-1 w-full" type="text" name="deskripsi" :value="old('deskripsi')" required />
                            <x-input-error :messages="$errors->get('deskripsi')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="total_pendapatan" :value="__('Total Pendapatan (Rp)')" />
                            <x-text-input id="total_pendapatan" class="block mt-1 w-full" type="number" name="total_pendapatan" :value="old('total_pendapatan')" required />
                            <x-input-error :messages="$errors->get('total_pendapatan')" class="mt-2" />
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button>Simpan Data</x-primary-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>