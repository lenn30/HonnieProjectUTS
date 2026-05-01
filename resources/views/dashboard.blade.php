<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-center">
                
                <!-- Total Income -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-3xl p-10">
                    <h3 class="text-xl font-bold text-black mb-4">Total Income</h3>
                    <p class="text-3xl text-green-500">Rp{{ number_format($totalIncome, 0, ',', '.') }}</p>
                </div>

                <!-- Total Expense -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-3xl p-10">
                    <h3 class="text-xl font-bold text-black mb-4">Total Expense</h3>
                    <p class="text-3xl text-red-500">Rp{{ number_format($totalExpense, 0, ',', '.') }}</p>
                </div>

                <!-- Balance -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-3xl p-10">
                    <h3 class="text-xl font-bold text-black mb-4">Balance</h3>
                    <p class="text-3xl text-green-500">Rp{{ number_format($balance, 0, ',', '.') }}</p>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>