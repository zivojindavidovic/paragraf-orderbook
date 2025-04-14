<?php

namespace App\Repository;

use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class OrderRepository implements OrderManyCriteriaRepository, OrderPersistenceRepository
{
    public function getManyByTypeAndStockId(string $type, int $stockId, string $order, int $limit): Collection
    {
        return Order::where(Order::KEY_TYPE, $type)
            ->where(Order::KEY_STOCK_ID, $stockId)
            ->orderBy(Order::KEY_PRICE, $order)
            ->limit($limit)
            ->get();
    }

    public function save(array $order): Order
    {
        return Order::create([
            Order::KEY_TYPE => $order['type'],
            Order::KEY_STOCK_ID => $order['stock_id'],
            Order::KEY_PRICE => $order['price'],
            Order::KEY_QUANTITY => $order['quantity'],
            Order::KEY_USER_ID => $order['user_id'],
        ]);
    }

    public function update(int $orderId, array $order): ?Order
    {
        $foundOrder = Order::find($orderId);

        if ($foundOrder === null) {
            return null;
        }

        $foundOrder->update([
            Order::KEY_TYPE => $order['type'] ?? $foundOrder->type,
            Order::KEY_STOCK_ID => $order['stock_id'] ?? $foundOrder->stock_id,
            Order::KEY_PRICE => $order['price'] ?? $foundOrder->price,
            Order::KEY_QUANTITY => $order['quantity'] ?? $foundOrder->quantity,
            Order::KEY_USER_ID => $order['user_id'] ?? $foundOrder->user_id,
        ]);

        return $foundOrder;
    }

    public function getManyByUserId(int $userId): LengthAwarePaginator
    {
        return Order::where(Order::KEY_USER_ID, $userId)
            ->paginate(10);
    }
}
