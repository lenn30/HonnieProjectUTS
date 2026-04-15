<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tambah Pesanan Baru</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <form action="{{ route('orders.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block">Nama Konsumen</label>
                        <input type="text" name="nama_konsumen" class="w-full border rounded p-2" required>
                    </div>
                    <div class="mb-4">
                        <label class="block">Nama Barang</label>
                        <input type="text" name="nama_barang" class="w-full border rounded p-2" required>
                    </div>
                    <div class="mb-4">
                        <label class="block">Jumlah Pesanan</label>
                        <input type="number" name="jumlah_pesanan" class="w-full border rounded p-2" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Status</label>
                        <select name="status" class="w-full border-gray-300 rounded-md shadow-sm">
                            <option value="Belum Terkirim">Belum Terkirim</option>
                            <option value="Terkirim">Terkirim</option>
                        </select>
                    </div>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan Pesanan</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>