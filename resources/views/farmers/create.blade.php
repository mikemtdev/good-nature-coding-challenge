
<x-app-layout>
    <form action="{{ route('farmers.store') }}" method="POST">
        @csrf
        <!-- Name Field -->
        <div class="mb-4">
            <label for="name" class="block text-gray-700 dark:text-gray-200 font-medium">Name</label>
            <input
                type="text"
                id="name"
                name="name"
                class="w-full mt-1 p-3 border rounded-lg bg-gray-50 dark:bg-gray-700 text-gray-800 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                placeholder="Enter farmer's name"
                required
            />
        </div>

        <!-- Phone Field -->
        <div class="mb-4">
            <label for="phone" class="block text-gray-700 dark:text-gray-200 font-medium">Phone</label>
            <input
                type="tel"
                id="phone"
                name="phone"
                class="w-full mt-1 p-3 border rounded-lg bg-gray-50 dark:bg-gray-700 text-gray-800 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                placeholder="Enter phone number"
                required
            />
        </div>

        <!-- Location Field -->
        <div class="mb-4">
            <label for="location" class="block text-gray-700 dark:text-gray-200 font-medium">Location</label>
            <input
                type="text"
                id="location"
                name="location"
                class="w-full mt-1 p-3 border rounded-lg bg-gray-50 dark:bg-gray-700 text-gray-800 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                placeholder="Enter location"
                required
            />
        </div>

        <!-- Submit Button -->
        <div class="mt-6">
            <button
                type="submit"
                class="w-full bg-blue-500 text-white py-3 rounded-lg hover:bg-blue-600 focus:ring-2 focus:ring-blue-400 focus:outline-none"
            >
                Add Farmer
            </button>
        </div>
    </form>
</x-app-layout>
