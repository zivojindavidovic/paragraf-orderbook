<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrderRequest;
use App\Services\OrderPersistence;
use Illuminate\Http\RedirectResponse;

class OrderController extends Controller
{
    private OrderPersistence $orderPersistence;

    public function __construct(OrderPersistence $orderPersistence)
    {
        $this->orderPersistence = $orderPersistence;
    }

    public function createOrder(CreateOrderRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $this->orderPersistence->saveOrderAndEmmitChanges($data);

        return redirect('/stocks/' . $data['stock_id']);
    }
}
