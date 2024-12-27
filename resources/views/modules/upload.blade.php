<x-app-layout>

    <div class="p-6 max-w-md mx-auto bg-white dark:bg-gray-800 shadow-lg rounded-lg">
        <h2 class="text-2xl font-bold text-gray-700 dark:text-gray-100 mb-4">Upload Module</h2>

        <!-- Display Errors -->
        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-800 rounded-lg">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Success Message -->
        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('modules.upload') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="module" class="block text-gray-700 dark:text-gray-200">Module (.zip)</label>
                <input
                    type="file"
                    id="module"
                    name="module"
                    accept=".zip"
                    class="w-full mt-2 p-2 border rounded-lg bg-gray-50 dark:bg-gray-700 text-gray-800 dark:text-gray-100 focus:ring-2 focus:ring-blue-500"
                    required
                />
            </div>

            <button
                type="submit"
                class="w-full py-2 px-4 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:ring-2 focus:ring-blue-400"
            >
                Upload and Install
            </button>
        </form>
    </div>
</x-app-layout>
