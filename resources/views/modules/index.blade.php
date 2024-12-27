<x-app-layout>
@php
//dd($modules)
@endphp

    <!-- Flash Messages -->
    @if (session('success'))
        <div class="p-4 mb-4 bg-green-100 text-green-800 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex  items-center justify-between pb-4 border-b border-gray-300">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Module Management</h1>
        <a
            href="/modules/upload"
            class="px-4 py-2 bg-blue-500 text-white font-medium rounded-lg hover:bg-blue-600"
        >
            + Add Module
        </a>
    </div>

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
                <!-- Delete Module Form -->
                <form action="{{ route('modules.delete', basename($module['path'])) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button
                        type="submit"
                        class="px-3 py-1 bg-red-500 text-white rounded-lg hover:bg-red-600"
                        onclick="return confirm('Are you sure you want to delete this module?')"
                    >
                        Delete
                    </button>
                </form>
            </div>
        @endforeach
    </div>

</x-app-layout>
