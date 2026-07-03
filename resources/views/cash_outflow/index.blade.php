<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cash Outflow (Flow Out)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <p class="text-gray-600 font-medium text-sm">Total Expense</p>
                        <h2 class="text-3xl font-bold text-red-600">Rp{{ number_format($totalExpense, 0, ',', '.') }}</h2>
                    </div>
                    <a href="{{ route('cash-outflow.create') }}" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700">
                        Tambah Data
                    </a>
                </div>

                @if (session('success'))
                    <div class="mb-4 text-sm font-medium text-green-600">
                        {{ session('success') }}
                    </div>
                @endif

                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b-2 border-gray-100">
                            <th class="py-4 px-2">Tanggal</th>
                            <th class="py-4 px-2">User</th> <th class="py-4 px-2">Keterangan</th>
                            <th class="py-4 px-2">Harga</th>
                            <th class="py-4 px-2 text-center">Qty</th>
                            <th class="py-4 px-2">Total</th>
                            <th class="py-4 px-2 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($cashOutflows as $item)
                            <tr class="border-b border-gray-50 hover:bg-gray-50">
                                <td class="py-4 px-2">{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</td>
                                
                                <td class="py-4 px-2 text-gray-700">{{ $item->user->name ?? 'Tidak Ada' }}</td>
                                
                                <td class="py-4 px-2">{{ $item->keterangan }}</td>
                                <td class="py-4 px-2">Rp{{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                                <td class="py-4 px-2 text-center">{{ $item->qty }}</td>
                                <td class="py-4 px-2 font-semibold text-red-600">Rp{{ number_format($item->total, 0, ',', '.') }}</td>
                                <td class="py-4 px-2 text-center flex justify-center gap-2">
                                    <a href="{{ route('cash-outflow.edit', $item->id) }}" class="px-4 py-1 bg-blue-400 text-white rounded-md hover:bg-blue-500">Edit</a>
                                    <form action="{{ route('cash-outflow.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-4 py-1 bg-red-500 text-white rounded-md hover:bg-red-600">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="py-8 text-center text-gray-500">Belum ada pengeluaran.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-4">
                    {{ $cashOutflows->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>