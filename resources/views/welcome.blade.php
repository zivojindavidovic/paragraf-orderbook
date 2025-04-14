<x-layout>
    <div class="max-w-6xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Home Page</h1>

        @if ($orders->isEmpty())
            <div class="p-6 bg-yellow-100 text-yellow-800 rounded-lg shadow">
                You have no orders yet.
            </div>
        @else
            <div class="overflow-x-auto bg-white shadow rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase">Order ID</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase">Type</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase">Price</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase">Quantity</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase">Stock ID</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase">Created At</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                    @foreach ($orders as $order)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm text-gray-800">{{ $order->order_id }}</td>
                            <td class="px-6 py-4 text-sm text-gray-800">
                                    <span class="inline-block px-2 py-1 rounded-full text-xs font-semibold
                                        {{ $order->type === 'buy' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ ucfirst($order->type) }}
                                    </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-800">{{ number_format($order->price) }}</td>
                            <td class="px-6 py-4 text-sm text-gray-800">{{ $order->quantity }}</td>
                            <td class="px-6 py-4 text-sm text-gray-800">{{ $order->stock_id }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $order->created_at->format('Y-m-d H:i') }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <div class="mt-6 flex justify-center">
                    {{ $orders->links('vendor.pagination.tailwind') }}
                </div>
            </div>
        @endif
    </div>
</x-layout>
