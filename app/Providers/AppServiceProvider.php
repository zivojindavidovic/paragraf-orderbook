<?php

namespace App\Providers;

use App\Repository\OrderManyCriteriaRepository;
use App\Repository\OrderPersistenceRepository;
use App\Repository\OrderRepository;
use App\Repository\StockManyRepository;
use App\Repository\StockRepository;
use App\Repository\UserPersistenceRepository;
use App\Repository\UserRepository;
use App\Services\AuthUser;
use App\Services\OrderPersistence;
use App\Services\OrderRetriever;
use App\Services\OrderService;
use App\Services\StockRetriever;
use App\Services\StockService;
use App\Services\UserPersistence;
use App\Services\UserService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(StockManyRepository::class, StockRepository::class);
        $this->app->bind(StockRetriever::class, StockService::class);
        $this->app->bind(OrderManyCriteriaRepository::class, OrderRepository::class);
        $this->app->bind(OrderPersistenceRepository::class, OrderRepository::class);
        $this->app->bind(OrderRetriever::class, OrderService::class);
        $this->app->bind(OrderPersistence::class, OrderService::class);
        $this->app->bind(UserPersistenceRepository::class, UserRepository::class);
        $this->app->bind(UserPersistence::class, UserService::class);
        $this->app->bind(AuthUser::class, UserService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
    }
}
