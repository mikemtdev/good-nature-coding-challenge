<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

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
                    <h5 class="mb-4 text-xl font-medium  text-center mx-auto text-gray-900 dark:text-gray-100">Total Farmers </h5>
                    <div class="flex items-baseline text-gray-900  text-center">
                        <span class="text-3xl font-semibold text-center mx-auto text-gray-900 dark:text-gray-100"> {{ $no_of_farmers}}</span>

                        <span
                            class="text-5xl font-extrabold tracking-tight">
                        </span>
                    </div>
                </div>
                {{--Card one--}}

                @php

                    $formated_total_amount = new NumberFormatter("en", NumberFormatter::CURRENCY);
                   // Outputs "$12,345.00"

                    //
                @endphp
                <div
                    class="w-full max-w-sm p-4 bg-white dark:bg-gray-800 rounded-lg shadow sm:p-8 ">
                    <h5 class="mb-4 text-xl font-medium  text-center mx-auto text-gray-900 dark:text-gray-100">Total Borrowed </h5>
                    <div class="flex items-baseline text-gray-900  text-center">
                        <span class="text-3xl font-semibold text-center mx-auto text-gray-900 dark:text-gray-100"> {{  $formated_total_amount->formatCurrency($total_borrowed, "ZMW")}}</span>

                        <span
                            class="text-5xl font-extrabold tracking-tight">
                        </span>
                    </div>
                </div>
                {{--Card one--}}


            </div>

        </div>
    </div>
</x-app-layout>
