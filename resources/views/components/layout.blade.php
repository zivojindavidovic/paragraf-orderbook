<!doctype html>
<html lang="en" class="h-full bg-gray-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-full">
@vite('resources/js/app.js')
<div class="min-h-full">
    <nav class="bg-gray-800">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">
                <div class="flex items-center">
                    <div class="hidden md:block">
                        <div class="ml-10 flex items-baseline space-x-4">
                            @auth
                                <x-nav-link href="/" :active="request()->is('/')">Home</x-nav-link>
                                <x-nav-link href="/stocks" :active="request()->is('stocks')">Stocks</x-nav-link>
                                <form action="/logout" method="POST" class="inline">
                                    @csrf
                                    <x-form-button>Log out</x-form-button>
                                </form>
                            @else
                                <x-nav-link href="/register" :active="request()->is('register')">Register</x-nav-link>
                                <x-nav-link href="/login" :active="request()->is('login')">Login</x-nav-link>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <main>
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            {{ $slot }}
        </div>
    </main>
</div>
<script>
    setTimeout(() => {
        window.Echo.channel('order-book')
            .listen('EmmitOrderBookChanges', (e) => {
                console.log(e);

                const sellOrdersTable = document.getElementById('sellOrdersTable');
                const buyOrdersTable = document.getElementById('buyOrdersTable');

                console.log(sellOrdersTable)
                console.log(buyOrdersTable)

                if (!sellOrdersTable || !buyOrdersTable) {
                    return;
                }

                sellOrdersTable.innerHTML = '';
                e.sellOrders.forEach(order => {
                    console.log('Adding sell row:', order);
                    const row = document.createElement('tr');
                    row.classList.add('border-b', 'border-red-300', 'hover:bg-red-100');
                    row.innerHTML = `<td class="px-4 py-2">${order.quantity}</td><td class="px-4 py-2">${order.price}</td>`;
                    sellOrdersTable.appendChild(row);
                });

                buyOrdersTable.innerHTML = '';
                e.buyOrders.forEach(order => {
                    console.log('Adding buy row:', order);
                    const row = document.createElement('tr');
                    row.classList.add('border-b', 'border-green-300', 'hover:bg-green-100');
                    row.innerHTML = `<td class="px-4 py-2">${order.quantity}</td><td class="px-4 py-2">${order.price}</td>`;
                    buyOrdersTable.appendChild(row);
                });
            })
    }, 200);
</script>

</body>
</html>
