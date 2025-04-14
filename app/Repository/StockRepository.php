<?php

namespace App\Repository;

use App\Models\Stock;
use Illuminate\Pagination\LengthAwarePaginator;

class StockRepository implements StockManyRepository
{
    public function getMany(): LengthAwarePaginator
    {
        return Stock::paginate(10);
    }
}
