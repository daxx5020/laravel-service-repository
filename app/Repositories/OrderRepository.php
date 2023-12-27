<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\OrderItem;

class OrderRepository{
    protected $order;
    protected $OrderItem;

    public function __construct(Order $order, OrderItem $OrderItem)
    {
        $this->order = $order;
        $this->OrderItem = $OrderItem;
    }

    public function orders($id)
    {
        $orders = $this->order->with('orderItems.product')->where('user_id',$id)->get();
        return $orders;
    }

    public function ordercreate($userId, $total)
    {
        $order = Order::create([
            'user_id' => $userId,
            'total_price' => $total,
        ]);

        return $order;
    }

    public function orderitemcreate($order, $cartItem)
    {
        $orderitems = OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $cartItem->product_id,
            'quantity' => $cartItem->quantity,
            'price' => $cartItem->product->price,
        ]);
        return $orderitems;
    }
}