<?php

namespace App\Services;

use App\Repositories\AdminRepository;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;
use Illuminate\Support\Facades\Log;
use Exception;


class AdminService
{

    protected $adminRepository;


    public function __construct(AdminRepository $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    public function viewcategory($id = null)
    {

        if ($id) {
            return $this->adminRepository->viewcategory($id);
        } else {
            return $this->adminRepository->viewcategory();
        }


    }

    public function addcategory($data)
    {

        $category = $this->adminRepository->addcategory($data);
        return $category;
    }

    public function deletecategory($id)
    {
        DB::beginTransaction();

        try {
            $category = $this->adminRepository->deletecategory($id);

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to delete category data');
        }

        DB::commit();

        return $category;
    }


    public function updatecategory($data, $id)
    {
        DB::beginTransaction();
        try {
            $category = $this->adminRepository->updatecategory($data, $id);

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to edit category data');
        }

        DB::commit();

        return $category;

    }


    public function addproduct($data)
    {
        $product = $this->adminRepository->addproduct($data);
        return $product;
    }

    public function viewproduct($id = null)
    {
        if ($id) {
            return $this->adminRepository->viewproduct($id);
        } else {
            return $this->adminRepository->viewproduct();
        }
    }

    public function deleteproduct($id)
    {
        DB::beginTransaction();

        try {
            $product = $this->adminRepository->deleteproduct($id);

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to delete product data');
        }

        DB::commit();

        return $product;
    }

    public function updateproduct($id, $data)
    {
        DB::beginTransaction();
        try {
            $product = $this->adminRepository->updateproduct($id, $data);

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to edit product data');
        }

        DB::commit();

        return $product;
    }


    public function filtercategory($categoryId)
    {
        return $this->adminRepository->filterproduct($categoryId);

    }


    public function cartitem($userId)
    {
        return $this->adminRepository->cartitems($userId);

    }

    public function total($userId)
    {
        $cartItems = $this->adminRepository->cartitems($userId);
        $total = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });
        return $total;
    }

    public function removecart($id)
    {
        DB::beginTransaction();

        try {
            $product = $this->adminRepository->removecart($id);

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
        return $this->adminRepository->existingCartItem($productId);
    }

    public function quantityadd($productId,$quantity)
    {
        $this->adminRepository->qunatityadd($productId,$quantity);
    }

    public function cartadd($productId,$quantity)
    {
        $this->adminRepository->cartadd($productId,$quantity);

    }

    public function order($id)
    {
        return $this->adminRepository->orders($id);
    }

    public function ordercreate($userId, $total)
    {
        return $this->adminRepository->ordercreate($userId, $total);
    }

    public function orderitemcreate($order, $cartItem)
    {
        $this->adminRepository->orderitemcreate($order, $cartItem);
    }

    public function emptycart($cartitem)
    {
        DB::beginTransaction();

        try {
            $cart = $this->adminRepository->emptycart($cartitem);

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to delete cart data');
        }

        DB::commit();

        return $cart;

    }


    public function updatecart($itemId,$quantity)
    {
        DB::beginTransaction();
        try {
            $item = $this->adminRepository->updatecart($itemId,$quantity);

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to edit cart quantity');
        }

        DB::commit();

        return $item;
    }

}