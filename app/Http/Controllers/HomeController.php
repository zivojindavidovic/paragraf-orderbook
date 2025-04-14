<?php

namespace App\Http\Controllers;

use App\Services\OrderRetriever;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class HomeController extends Controller
{
    private OrderRetriever $orderRetriever;

    public function __construct(OrderRetriever $orderRetriever)
    {
        $this->orderRetriever = $orderRetriever;
    }

    public function index(): View|Application|Factory
    {
        $userId = auth()->user()->user_id;

        return view('welcome', [
            'orders' => $this->orderRetriever->getOrdersByUserId($userId)
        ]);
    }
}
