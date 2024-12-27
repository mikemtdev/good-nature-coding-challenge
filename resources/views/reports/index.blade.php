<x-app-layout>
    <div class="p-6 max-w-7xl mx-auto">
    <!-- Metrics Overview -->
    <div class="   flex
            mb-5 gap-6 mt-6">
        <div
            class="w-full max-w-sm p-4 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg  rounded-lg  sm:p-8 ">

        <h3 class="text-lg font-bold text-gray-700 dark:text-gray-100">Total Farmers</h3>
            <p class="text-3xl mt-4  font-bold text-gray-900 dark:text-gray-100">{{ $totalFarmers }}</p>
        </div>

        @if(\App\Helpers\ModuleHelper::isModuleLoaded("LoanManagement"))
        <div
            class="w-full max-w-sm p-4 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg  rounded-lg  sm:p-8 ">

        <h3 class="text-lg font-bold text-gray-700 dark:text-gray-100">Total Loans</h3>
            <p class="mt-4 text-3xl font-bold text-gray-900 dark:text-gray-100">{{ $totalLoans }}</p>
        </div>
        <div
            class="w-full max-w-sm p-4 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg  rounded-lg  sm:p-8 ">

        <h3 class="text-lg font-bold text-gray-700 dark:text-gray-100">Total Amount Disbursed</h3>
            <p class="mt-4 text-3xl font-bold text-gray-900 dark:text-gray-100">${{ number_format($totalAmount, 2) }}</p>
        </div>
        <div
            class="w-full max-w-sm p-4 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg  rounded-lg  sm:p-8 ">

        <h3 class="text-lg font-bold text-gray-700 dark:text-gray-100">Pending Loans</h3>
            <p class="mt-4 text-3xl font-bold text-gray-900 dark:text-gray-100">{{ $pendingLoans }}</p>
        </div>
        @endif
    </div>
    </div>
</x-app-layout>
