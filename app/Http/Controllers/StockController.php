<?php

namespace App\Http\Controllers;

use App\Services\StockRetriever;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class StockController extends Controller
{
    private StockRetriever $stockRetriever;

    public function __construct(StockRetriever $stockRetriever)
    {
        $this->stockRetriever = $stockRetriever;
    }

    public function getAllStocks(): View|Application|Factory
    {
        return view('stocks.allStocks', [
            'stocks' => $this->stockRetriever->getAllStocks()
        ]);
    }

    public function getOrderBookByStockId(int $stockId): View|Application|Factory
    {
        return view('stocks.orderBook', $this->stockRetriever->getOrderBookByStockId($stockId));
    }
}
