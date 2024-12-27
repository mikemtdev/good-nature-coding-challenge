<x-app-layout>

<div class="p-6  min-h-full">
    <!-- Page Header -->
    <div class="flex  items-center justify-between pb-4 border-b border-gray-300">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Farmers Management</h1>
        <a
            href="/farmers/create"
            class="px-4 py-2 bg-blue-500 text-white font-medium rounded-lg hover:bg-blue-600"
        >
            + Add Farmer
        </a>
    </div>

    <!-- Search Bar -->
    <div class="flex items-center mt-4">
        <input
            type="text"
            placeholder="Search farmers..."
            class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
        />
        <button
            class="ml-3 px-4 py-2 bg-blue-500 text-white font-medium rounded-lg hover:bg-blue-600"
        >
            Search
        </button>
    </div>

    <!-- Farmers Table -->
    <div class="mt-6 shadow rounded-lg">
        <table class="w-full text-left">
            <thead class="bg-gray-200">
            <tr>
                <th class="px-4 py-2 text-gray-600 font-medium">#</th>
                <th class="px-4 py-2 text-gray-600 font-medium">Name</th>
                <th class="px-4 py-2 text-gray-600 font-medium">Phone</th>
                <th class="px-4 py-2 text-gray-600 font-medium">Location</th>
                <th class="px-4 py-2 text-gray-600 font-medium">Actions</th>
            </tr>
            </thead>
            <tbody>
            <!-- Example Row -->

            @foreach ($farmers as $farmer)
                <tr class="border-t">
                    <td class="px-4 py-3 text-gray-900 dark:text-gray-100">{{ $loop->iteration }}</td>
                    <td class="px-4 py-3 text-gray-900 dark:text-gray-100">{{ $farmer->name }}</td>
                    <td class="px-4 py-3 text-gray-900 dark:text-gray-100">{{ $farmer->phone }}</td>
                    <td class="px-4 py-3 text-gray-900 dark:text-gray-100">{{ $farmer->location }}</td>
                    <td class="px-4 py-3">
                        <div class="flex space-x-2">
                            <a
                                href="{{ route('farmers.edit', $farmer->id) }}"
                                class="px-3 py-1 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600"
                            >
                                Edit
                            </a>
                            <form
                                action="{{ route('farmers.destroy', $farmer->id) }}"
                                method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this farmer?')"
                            >
                                @csrf
                                @method('DELETE')
                                <input
                                    type="submit"
                                    value="Delete"
                                    class="px-3 py-1 bg-red-500 text-white rounded-lg hover:bg-red-600 cursor-pointer"
                                />
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            <tr class="border-t">
                <td class="px-4 py-3 text-gray-900 dark:text-gray-100">1</td>
                <td class="px-4 py-3 text-gray-900 dark:text-gray-100">John Doe</td>
                <td class="px-4 py-3 text-gray-900 dark:text-gray-100">123-456-7890</td>
                <td class="px-4 py-3 text-gray-900 dark:text-gray-100">Village A</td>
                <td class="px-4 py-3">
                    <div class="flex space-x-2">
                        <a
                            href="/farmers/1/edit"
                            class="px-3 py-1 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600"
                        >
                            Edit
                        </a>
                        <form
                            action="/farmers/1"
                            method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this farmers?')"
                        >
                            <input type="hidden" name="_method" value="DELETE" />
                            <input
                                type="submit"
                                value="Delete"
                                class="px-3 py-1 bg-red-500 text-white rounded-lg hover:bg-red-600 cursor-pointer"
                            />
                        </form>
                    </div>
                </td>
            </tr>
            <!-- Repeat rows dynamically -->
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <!-- Pagination Links -->
    <div class="mt-6">
        {{ $farmers->links() }}
    </div>
</div>
</x-app-layout>
