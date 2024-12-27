<x-app-layout>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="
            flex
            gap-6
            mb-5
            ">
                {{--Card one--}}
                <div
                    class="w-full max-w-sm p-4 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg  rounded-lg  sm:p-8 ">

                    <h3 class="text-lg font-semibold text-gray-100 dark:text-gray-300">Total Farmers</h3>
                    <p class="mt-4 text-3xl font-bold text-gray-900 dark:text-gray-100">{{ $no_of_farmers}}</p>
                    <a
                        href="/farmers"
                        class="mt-2 inline-block text-sm text-blue-600 hover:underline"
                    >
                        View Farmers
                    </a>
                </div>
                {{--Card two--}}

                @php
                    $formated_total_amount = new NumberFormatter("en", NumberFormatter::CURRENCY);

                @endphp
                @if(\App\Helpers\ModuleHelper::isModuleLoaded("LoanManagement"))
                    <div
                        class="w-full max-w-sm p-4 bg-white dark:bg-gray-800 rounded-lg shadow sm:p-8 ">

                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Total Loans</h3>
                        <p class="mt-4 text-3xl font-bold text-gray-900 dark:text-gray-100">{{  $formated_total_amount->formatCurrency($total_borrowed, "ZMW")}}</p>
                        <a
                            href="/loans"
                            class="mt-2 inline-block text-sm text-green-600 hover:underline"
                        >
                            Manage Loans
                        </a>
                    </div>

                @endif


                    @if(\App\Helpers\ModuleHelper::isModuleLoaded("LoanManagement"))
                {{--Card three--}}
                <div  class="w-full max-w-sm p-4 bg-white dark:bg-gray-800 rounded-lg shadow sm:p-8 ">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Loan Status</h3>
                    <div class="mt-4">
                        <div class="flex justify-between">
                            <span class="text-gray-900 dark:text-gray-100">Approved</span>
                            <span class="font-bold
                            text-gray-900 dark:text-gray-100">{{$approved_loans}}</span>
                        </div>
                        <div class="flex justify-between mt-2">
                            <span class="text-gray-900 dark:text-gray-100">Pending</span>
                            <span class="font-bold
                            text-gray-900 dark:text-gray-100">{{$pending_loans}}</span>
                        </div>
                        <div class="flex justify-between mt-2">
                            <span class="text-gray-900 dark:text-gray-100">Rejected</span>
                            <span class="font-bold
                            text-gray-900 dark:text-gray-100">{{$rejected_loans}}</span>
                        </div>
                    </div>
                    <a
                        href="/reports"
                        class="mt-4 inline-block text-sm text-gray-900 dark:text-gray-400 hover:underline"
                    >
                        View Detailed Reports
                    </a>
                </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
