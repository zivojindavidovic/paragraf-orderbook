<x-layout>
    <div class="max-w-6xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Available Stocks</h1>

        @if ($stocks->isEmpty())
            <div class="p-6 bg-yellow-100 text-yellow-800 rounded-lg shadow">
                No stocks available at the moment.
            </div>
        @else
            <div class="overflow-x-auto bg-white shadow rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase">Stock ID</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase">Symbol</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase">Created At</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                    @foreach ($stocks as $stock)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm text-gray-800">{{ $stock->stock_id }}</td>
                            <td class="px-6 py-4 text-sm text-blue-700 font-medium">{{ $stock->symbol }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $stock->created_at->format('Y-m-d H:i') }}</td>
                            <td class="px-6 py-4 text-sm">
                                <a href="/stocks/{{ $stock->stock_id }}"
                                   class="text-indigo-600 hover:text-indigo-900 font-medium transition">
                                    View
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-8 flex justify-center">
                {{ $stocks->links('vendor.pagination.tailwind') }}
            </div>
        @endif
    </div>
</x-layout>
