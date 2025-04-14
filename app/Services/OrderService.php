<?php

namespace App\Services;

use App\Enums\OrderTypeValue;
use App\Enums\SqlOrderDirectionValue;
use App\Events\EmmitOrderBookChanges;
use App\Models\Order;
use App\Repository\OrderManyCriteriaRepository;
use App\Repository\OrderPersistenceRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class OrderService implements OrderRetriever, OrderPersistence
{
    private OrderManyCriteriaRepository $orderManyCriteriaRepository;
    private OrderPersistenceRepository $orderPersistenceRepository;

    public function __construct(OrderManyCriteriaRepository $orderManyCriteriaRepository, OrderPersistenceRepository $orderPersistenceRepository)
    {
        $this->orderManyCriteriaRepository = $orderManyCriteriaRepository;
        $this->orderPersistenceRepository = $orderPersistenceRepository;
    }

    public function getTopTenBuyOrdersByStockId(int $stockId): Collection
    {
        return $this->orderManyCriteriaRepository->getManyByTypeAndStockId(OrderTypeValue::BUY->value, $stockId, SqlOrderDirectionValue::DESC->value, 10);
    }

    public function getTopTenSellOrdersByStockId(int $stockId): Collection
    {
        return $this->orderManyCriteriaRepository->getManyByTypeAndStockId(OrderTypeValue::SELL->value, $stockId, SqlOrderDirectionValue::ASC->value, 10);
    }

    public function saveOrder(array $order): Order
    {
        return $this->orderPersistenceRepository->save($order);
    }

    public function saveOrderAndEmmitChanges(array $order): Order
    {
        $savedOrder = $this->saveOrder($order);

        $this->emmitOrderBookChanges($order['stock_id']);

        return $savedOrder;
    }

    public function updateOrder(int $orderId, array $order): ?Order
    {
        return $this->orderPersistenceRepository->update($orderId, $order);
    }

    public function updateOrderAndEmmitChanges(int $orderId, array $order): ?Order
    {
        $updatedOrder = $this->updateOrder($orderId, $order);

        if ($updatedOrder !== null) {
            $this->emmitOrderBookChanges($order['stock_id']);
        }

        return $updatedOrder;
    }

    public function getOrdersByUserId(int $userId): LengthAwarePaginator
    {
        return $this->orderManyCriteriaRepository->getManyByUserId($userId);
    }

    private function emmitOrderBookChanges(int $stockId): void
    {
        $orderRetriever = app(OrderRetriever::class);
        event(new EmmitOrderBookChanges($orderRetriever, $stockId));
    }
}
