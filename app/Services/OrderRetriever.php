<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface OrderRetriever
{
    public function getTopTenBuyOrdersByStockId(int $stockId): Collection;
    public function getTopTenSellOrdersByStockId(int $stockId): Collection;
    public function getOrdersByUserId(int $userId): LengthAwarePaginator;
}
