<?php

namespace App\Services;

use App\Models\Order;

interface OrderPersistence
{
    public function saveOrder(array $order): Order;

    public function saveOrderAndEmmitChanges(array $order): Order;

    public function updateOrder(int $orderId, array $order): ?Order;

    public function updateOrderAndEmmitChanges(int $stockId, int $orderId, array $order): ?Order;
}
