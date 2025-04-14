<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface OrderManyCriteriaRepository
{
    public function getManyByTypeAndStockId(string $type, int $stockId, string $order, int $limit): Collection;
    public function getManyByUserId(int $userId): LengthAwarePaginator;
}
