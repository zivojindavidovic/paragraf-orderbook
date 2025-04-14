<?php

namespace App\Services;

use App\Models\Order;
use App\Repository\StockManyRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class StockService implements StockRetriever, MatchingEngine
{
    private StockManyRepository $stockManyRepository;
    private OrderRetriever $orderRetriever;
    private OrderPersistence $orderPersistence;

    public function __construct(StockManyRepository $stockManyRepository, OrderRetriever $orderRetriever, OrderPersistence $orderPersistence)
    {
        $this->stockManyRepository = $stockManyRepository;
        $this->orderRetriever = $orderRetriever;
        $this->orderPersistence = $orderPersistence;
    }

    public function getAllStocks(): LengthAwarePaginator
    {
        return $this->stockManyRepository->getMany();
    }

    public function getOrderBookByStockId(int $stockId): array
    {
        return [
            'sellOrders' => $this->orderRetriever->getTopTenSellOrdersByStockId($stockId),
            'buyOrders' => $this->orderRetriever->getTopTenBuyOrdersByStockId($stockId)
        ];
    }

    public function matchOrders(int $stockId): array
    {
        $buyOrders = $this->orderRetriever->getTopTenBuyOrdersByStockId($stockId);
        $sellOrders = $this->orderRetriever->getTopTenSellOrdersByStockId($stockId);

        $matchedOrders = [];

        $i = 0;
        $j = 0;

        while ($i < count($sellOrders) && $j < count($buyOrders)) {
            $buy = $buyOrders[$i];
            $sell = $sellOrders[$j];

            if ($buy->price >= $sell->price) {
                $matchedQuantity = min($buy->quantity, $sell->quantity);

                $matchedOrders[] = [
                    Order::KEY_STOCK_ID => $stockId,
                    Order::KEY_BUY_ORDER_ID => $buy->order_id,
                    Order::KEY_SELL_ORDER_ID => $sell->order_id,
                    Order::KEY_PRICE => $sell->price,
                    Order::KEY_QUANTITY => $matchedQuantity
                ];

                print_r("Matched" . $buy->order_id . " + " . $sell->order_id);
                echo PHP_EOL;
                sleep(1);

                echo $buy->quantity . " Before Buy" . $sell->quantity . " Before Sell";
                echo PHP_EOL;
                $buy->quantity -= $matchedQuantity;
                $sell->quantity -= $matchedQuantity;
                echo $buy->quantity . " After Buy" . $sell->quantity . " After Sell";
                echo PHP_EOL;

                $this->orderPersistence->updateOrder($buy->order_id, [
                    Order::KEY_QUANTITY => $buy->quantity,
                ]);

                $this->orderPersistence->updateOrder($sell->order_id, [
                    Order::KEY_QUANTITY => $sell->quantity,
                ]);

                if ($buy->quantity === 0) {
                    $i++;
                }

                if ($sell->quantity === 0) {
                    $j++;
                }

                print_r("Done $i and $j");
                echo PHP_EOL;
                sleep(1);
            } else {
                break;
            }
        }

        return $matchedOrders;
    }
}
