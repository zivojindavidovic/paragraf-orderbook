<?php

namespace App\Console\Commands;

use App\Services\StockService;
use Illuminate\Console\Command;

class MatchOrdersDaemon extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:match-orders-daemon {order_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $orderId = $this->argument('order_id');
        $this->info("Starting order matching daemon");

        $result = app(StockService::class)->matchOrders($orderId);

        print_r($result);
    }
}
