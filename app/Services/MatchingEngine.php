<?php

namespace App\Services;

interface MatchingEngine
{
    public function matchOrders(int $stockId): array;
}
