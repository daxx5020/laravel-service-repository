<?php

namespace App\Services;

use App\Repositories\CartRepository;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;
use Illuminate\Support\Facades\Log;
use Exception;


class CartService{

    protected $CartRepository;

    public function __construct(CartRepository $CartRepository)
    {
        $this->CartRepository = $CartRepository;
    }

    public function cartitem($userId)
    {
        return $this->CartRepository->cartitems($userId);

    }

    public function total($userId)
    {
        $cartItems = $this->CartRepository->cartitems($userId);
        $total = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });
        return $total;
    }

    public function removecart($id)
    {
        DB::beginTransaction();

        try {
            $product = $this->CartRepository->removecart($id);

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to delete cart data');
        }

        DB::commit();

        return $product;
    }

    public function existingCartItem($productId)
    {
        return $this->CartRepository->existingCartItem($productId);
    }

    public function quantityadd($productId,$quantity)
    {
        $this->CartRepository->qunatityadd($productId,$quantity);
    }

    public function cartadd($productId,$quantity)
    {
        $this->CartRepository->cartadd($productId,$quantity);

    }

    public function emptycart($cartitem)
    {
        DB::beginTransaction();

        try {
            $cart = $this->CartRepository->emptycart($cartitem);

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to delete cart data');
        }

        DB::commit();

        return $cart;

    }


}