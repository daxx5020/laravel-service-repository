<?php

namespace App\Services;

use App\Repositories\OrderRepository;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;
use Illuminate\Support\Facades\Log;
use Exception;

class OrderService{
    protected $OrderRepository;

    public function __construct(OrderRepository $OrderRepository)
    {
        $this->OrderRepository = $OrderRepository;
    }

    public function order($id)
    {
        return $this->OrderRepository->orders($id);
    }

    public function ordercreate($userId, $total)
    {
        return $this->OrderRepository->ordercreate($userId, $total);
    }

    public function orderitemcreate($order, $cartItem)
    {
        $this->OrderRepository->orderitemcreate($order, $cartItem);
    }


}