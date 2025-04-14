<?php

namespace App\Services;

use Illuminate\Pagination\LengthAwarePaginator;

interface StockRetriever
{
    public function getAllStocks(): LengthAwarePaginator;

    public function getOrderBookByStockId(int $stockId): array;
}
