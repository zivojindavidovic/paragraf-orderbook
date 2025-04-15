<x-layout>
    <div class="max-w-6xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Order Book</h1>

        {{-- Buy Orders --}}
        <div class="mb-8">
            <h2 class="text-2xl font-semibold text-green-700 mb-4">Buy Orders</h2>
            <div class="overflow-x-auto bg-white shadow rounded-lg border border-green-300">
                <table class="min-w-full divide-y divide-green-200">
                    <thead class="bg-green-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-medium text-green-800 uppercase">Quantity</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-green-800 uppercase">Price</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-green-100" id="buyOrdersTable">
                    @forelse ($buyOrders as $buyOrder)
                        <tr class="hover:bg-green-50">
                            <td class="px-6 py-4 text-sm text-gray-800">{{ $buyOrder->quantity }}</td>
                            <td class="px-6 py-4 text-sm text-gray-800">{{ $buyOrder->price }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="px-6 py-4 text-center text-green-500">No buy orders available.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Sell Orders --}}
        <div class="mb-10">
            <h2 class="text-2xl font-semibold text-red-700 mb-4">Sell Orders</h2>
            <div class="overflow-x-auto bg-white shadow rounded-lg border border-red-300">
                <table class="min-w-full divide-y divide-red-200">
                    <thead class="bg-red-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-medium text-red-800 uppercase">Quantity</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-red-800 uppercase">Price</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-red-100" id="sellOrdersTable">
                    @forelse ($sellOrders as $sellOrder)
                        <tr class="hover:bg-red-50">
                            <td class="px-6 py-4 text-sm text-gray-800">{{ $sellOrder->quantity }}</td>
                            <td class="px-6 py-4 text-sm text-gray-800">{{ $sellOrder->price }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="px-6 py-4 text-center text-red-500">No sell orders available.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Create New Order --}}
        <div class="bg-gray-50 shadow rounded-lg p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Create New Order</h2>
            <form action="/orders" method="POST">
                @csrf
                <input type="hidden" name="stock_id" value="{{ request()->route('id') }}">

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Price</label>
                    <input type="number" name="price" step="0.01" required class="w-full mt-1 p-2 border rounded-md">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Quantity</label>
                    <input type="number" name="quantity" required class="w-full mt-1 p-2 border rounded-md">
                </div>

                <input type="hidden" name="user_id" value="{{ auth()->user()->user_id }}">

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Order Type</label>
                    <select name="type" required class="w-full mt-1 p-2 border rounded-md">
                        <option value="sell">Sell</option>
                        <option value="buy">Buy</option>
                    </select>
                </div>

                <button type="submit"
                        class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 transition">
                    Submit Order
                </button>
            </form>
        </div>
    </div>
</x-layout>
