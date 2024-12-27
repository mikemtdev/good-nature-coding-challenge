<x-app-layout>

    <div class="p-6 max-w-7xl mx-auto">

        <div class="flex  items-center justify-between pb-4 border-b border-gray-300">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Loans Management</h1>
            <a
                href="/loans/create"
                class="px-4 py-2 bg-blue-500 text-white font-medium rounded-lg hover:bg-blue-600"
            >
                + Add Loan
            </a>
        </div>
        <!-- Loan Table -->
        <div class="mt-6 bg-white dark:bg-gray-800 shadow rounded-lg">
            <table class="w-full text-left">
                <thead class="bg-gray-200 dark:bg-gray-700">
                <tr>
                    <th class="px-4 py-2 text-gray-600 dark:text-gray-300 font-medium">#</th>
                    <th class="px-4 py-2 text-gray-600 dark:text-gray-300 font-medium">Farmer</th>
                    <th class="px-4 py-2 text-gray-600 dark:text-gray-300 font-medium">Amount</th>
                    <th class="px-4 py-2 text-gray-600 dark:text-gray-300 font-medium">Interest Rate</th>
                    <th class="px-4 py-2 text-gray-600 dark:text-gray-300 font-medium">Repayment Duration</th>
                    <th class="px-4 py-2 text-gray-600 dark:text-gray-300 font-medium">Status</th>
                    <th class="px-4 py-2 text-gr    ay-600 dark:text-gray-300 font-medium">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($loans as $loan)
                    <tr class="border-t dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                        <td class="px-4 py-3 text-gray-900 dark:text-gray-100">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3 text-gray-900 dark:text-gray-100">{{ $loan->farmer->name }}</td>
                        <td class="px-4 py-3 text-gray-900 dark:text-gray-100">${{ number_format($loan->amount, 2) }}</td>
                        <td class="px-4 py-3 text-gray-900 dark:text-gray-100">{{ $loan->interest_rate }}%</td>
                        <td class="px-4 py-3 text-gray-900 dark:text-gray-100">{{ $loan->repayment_duration }} months</td>
                        <td class="px-4 py-3 text-gray-900 dark:text-gray-100">
                                <span
                                    class="px-2 py-1 rounded-full text-sm {{ $loan->status == 'approved' ? 'bg-green-500 text-white' : ($loan->status == 'pending' ? 'bg-yellow-500 text-white' : 'bg-red-500 text-white') }}"
                                >
                                    {{ ucfirst($loan->status) }}
                                </span>
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex space-x-2">
                                @if ($loan->status == 'pending')
                                    <form
                                        action="{{ route('loans.approve', $loan->id) }}"
                                        method="POST"
                                        class="inline"
                                    >
                                        @csrf
                                        <button
                                            type="submit"
                                            class="px-3 py-1 bg-green-500 text-white rounded-lg hover:bg-green-600"
                                        >
                                            Approve
                                        </button>
                                    </form>
                                    <form
                                        action="{{ route('loans.reject', $loan->id) }}"
                                        method="POST"
                                        class="inline"
                                    >
                                        @csrf
                                        <button
                                            type="submit"
                                            class="px-3 py-1 bg-red-500 text-white rounded-lg hover:bg-red-600"
                                        >
                                            Reject
                                        </button>
                                    </form>
                                @endif
                                @if ($loan->status == 'approved')
                                    <form
                                        action="{{ route('loans.repaid', $loan->id) }}"
                                        method="POST"
                                        class="inline"
                                    >
                                        @csrf
                                        <button
                                            type="submit"
                                            class="px-3 py-1 bg-blue-500 text-white rounded-lg hover:bg-blue-600"
                                        >
                                            Mark as Repaid
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $loans->links() }}
        </div>
    </div>
</x-app-layout>
