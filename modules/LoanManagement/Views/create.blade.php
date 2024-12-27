<x-app-layout>
    <div class="p-6 max-w-md mx-auto bg-white dark:bg-gray-800 shadow-lg rounded-lg">

        <form action="{{ route('loans.store') }}" method="POST">
            @csrf
            <!-- Select Farmer -->
            <div class="mb-4">
                <label for="farmer_id" class="block text-gray-700 dark:text-gray-200">Farmer</label>
                <select
                    id="farmer_id"
                    name="farmer_id"
                    class="w-full mt-2 p-2 border rounded-lg bg-gray-50 dark:bg-gray-700 text-gray-800 dark:text-gray-100 focus:ring-2 focus:ring-blue-500"
                    required
                >
                    <option value="" disabled selected>Select Farmer</option>
                    @foreach ($farmers as $farmer)
                        <option value="{{ $farmer->id }}">{{ $farmer->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Loan Amount -->
            <div class="mb-4">
                <label for="amount" class="block text-gray-700 dark:text-gray-200">Loan Amount</label>
                <input
                    type="number"
                    id="amount"
                    name="amount"
                    step="0.01"
                    class="w-full mt-2 p-2 border rounded-lg bg-gray-50 dark:bg-gray-700 text-gray-800 dark:text-gray-100 focus:ring-2 focus:ring-blue-500"
                    placeholder="Enter loan amount"
                    required
                />
            </div>

            <!-- Interest Rate -->
            <div class="mb-4">
                <label for="interest_rate" class="block text-gray-700 dark:text-gray-200">Interest Rate (%)</label>
                <input
                    type="number"
                    id="interest_rate"
                    name="interest_rate"
                    step="0.01"
                    class="w-full mt-2 p-2 border rounded-lg bg-gray-50 dark:bg-gray-700 text-gray-800 dark:text-gray-100 focus:ring-2 focus:ring-blue-500"
                    placeholder="Enter interest rate"
                    required
                />
            </div>

            <!-- Repayment Duration -->
            <div class="mb-4">
                <label for="repayment_duration" class="block text-gray-700 dark:text-gray-200">Repayment Duration (Months)</label>
                <input
                    type="number"
                    id="repayment_duration"
                    name="repayment_duration"
                    class="w-full mt-2 p-2 border rounded-lg bg-gray-50 dark:bg-gray-700 text-gray-800 dark:text-gray-100 focus:ring-2 focus:ring-blue-500"
                    placeholder="Enter duration in months"
                    required
                />
            </div>

            <!-- Submit Button -->
            <button
                type="submit"
                class="w-full py-2 px-4 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:ring-2 focus:ring-blue-400"
            >
                Add Loan
            </button>
        </form>
    </div>

</x-app-layout>
