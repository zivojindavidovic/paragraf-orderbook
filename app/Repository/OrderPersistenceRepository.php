<?php

namespace App\Repository;

use App\Models\Order;

interface OrderPersistenceRepository
{
    public function save(array $order): Order;
    public function update(int $orderId, array $order): ?Order;
}
