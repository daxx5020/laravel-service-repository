<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OrderService;

class OrderController extends Controller
{
    protected $OrderService;

    public function __construct(OrderService $OrderService)
    {
        $this->OrderService = $OrderService;
        $this->middleware('auth');
    }

    public function orders(){
        $id = auth()->id();
        $orders = $this->OrderService->order($id);
        return view('user.order', compact('orders'));
    }
}
