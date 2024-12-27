<x-app-layout>
@php
//dd($modules)
@endphp

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
        @foreach ($modules as $module)
            <div class="p-4 bg-white dark:bg-gray-800 shadow rounded-lg">
                <h2 class="text-lg font-bold text-gray-700 dark:text-gray-100">{{ $module['name'] }}</h2>
                <p class="text-sm text-gray-600 dark:text-gray-300 mb-4">{{ $module['description'] }}</p>

                <div class="flex items-center justify-between">
                    <span class="text-sm font-medium {{ $module['status'] === 'active' ? 'text-green-500' : 'text-red-500' }}">
                        {{ ucfirst($module['status']) }}
                    </span>
                    <form action="{{ route('modules.toggle', basename($module['path'])) }}" method="POST">
                        @csrf
                        <button
                            type="submit"
                            class="px-3 py-1 rounded-lg {{ $module['status'] === 'active' ? 'bg-red-500 text-white hover:bg-red-600' : 'bg-green-500 text-white hover:bg-green-600' }}"
                        >
                            {{ $module['status'] === 'active' ? 'Deactivate' : 'Activate' }}
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>

</x-app-layout>
