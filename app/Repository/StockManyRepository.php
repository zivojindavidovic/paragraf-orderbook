<?php

namespace App\Repository;

use Illuminate\Pagination\LengthAwarePaginator;

interface StockManyRepository
{
    public function getMany(): LengthAwarePaginator;
}
