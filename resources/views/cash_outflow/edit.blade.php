<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Pengeluaran</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <form method="POST" action="{{ route('cash-outflow.update', $cash_outflow->id) }}">
                    @csrf @method('PATCH')
                    <div class="grid grid-cols-1 gap-4">
                        <div>
                            <x-input-label value="Tanggal" />
                            <x-text-input class="block mt-1 w-full" type="date" name="tanggal" :value="$cash_outflow->tanggal" required />
                        </div>
                        <div>
                            <x-input-label value="Keterangan" />
                            <x-text-input class="block mt-1 w-full" type="text" name="keterangan" :value="$cash_outflow->keterangan" required />
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <x-input-label value="Harga Satuan" />
                                <x-text-input class="block mt-1 w-full" type="number" name="harga_satuan" :value="$cash_outflow->harga_satuan" required />
                            </div>
                            <div>
                                <x-input-label value="Quantity" />
                                <x-text-input class="block mt-1 w-full" type="number" name="qty" :value="$cash_outflow->qty" required />
                            </div>
                        </div>
                        <div class="flex justify-end mt-4">
                            <x-primary-button>Update</x-primary-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>