<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tambah Pengeluaran</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <form method="POST" action="{{ route('cash-outflow.store') }}">
                    @csrf
                    <div class="grid grid-cols-1 gap-4">
                        <div>
                            <x-input-label for="tanggal" value="Tanggal" />
                            <x-text-input id="tanggal" class="block mt-1 w-full" type="date" name="tanggal" required />
                        </div>
                        <div>
                            <x-input-label for="keterangan" value="Keterangan" />
                            <x-text-input id="keterangan" class="block mt-1 w-full" type="text" name="keterangan" required />
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="harga_satuan" value="Harga Satuan" />
                                <x-text-input id="harga_satuan" class="block mt-1 w-full" type="number" name="harga_satuan" required />
                            </div>
                            <div>
                                <x-input-label for="qty" value="Quantity" />
                                <x-text-input id="qty" class="block mt-1 w-full" type="number" name="qty" required />
                            </div>
                        </div>
                        <div class="flex justify-end mt-4">
                            <x-primary-button>Simpan</x-primary-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>