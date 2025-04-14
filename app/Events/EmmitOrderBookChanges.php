<?php

namespace App\Events;

use App\Services\OrderRetriever;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class EmmitOrderBookChanges implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private OrderRetriever $orderRetriever;
    private int $stockId;
    /**
     * Create a new event instance.
     */
    public function __construct(OrderRetriever $orderRetriever, int $stockId)
    {
        $this->orderRetriever = $orderRetriever;
        $this->stockId = $stockId;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('order-book'),
        ];
    }

    public function broadcastWith(): array
    {
        $sellOrders = $this->orderRetriever->getTopTenSellOrdersByStockId($this->stockId);
        $buyOrders = $this->orderRetriever->getTopTenBuyOrdersByStockId($this->stockId);

        return [
            'sellOrders' => $sellOrders,
            'buyOrders' => $buyOrders
        ];
    }
}
