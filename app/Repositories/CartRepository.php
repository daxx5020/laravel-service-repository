<?php

namespace App\Repositories;

use App\Models\Cart;

class CartRepository{

    protected $cart;

    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    public function cartitems($userId)
    {
        $cartItems = $this->cart->with('product')->where('user_id', $userId)->get();
        return $cartItems;
    }

    public function removecart($id)
    {
        $product = $this->cart->find($id)->delete();
        return $product;
    }

    public function existingCartItem($productId)
    {
        $existingCartItem = $this->cart::where('user_id', auth()->id())
            ->where('product_id', $productId)
            ->first();

        return $existingCartItem;
    }

    public function qunatityadd($productId,$quantity)
    {
        $existingCartItem = $this->cart::where('user_id', auth()->id())
            ->where('product_id', $productId)
            ->first();

        return $existingCartItem->update([
            'quantity' => $existingCartItem->quantity + $quantity,
        ]);
    }

    public function cartadd($productId,$quantity)
    {
        return Cart::create([
            'user_id' => auth()->id(),
            'product_id' => $productId,
            'quantity' => $quantity,
        ]);
    }

    public function emptycart($cartitem)
    {
        $cartitem->delete();
        return $cartitem;
    }
}
