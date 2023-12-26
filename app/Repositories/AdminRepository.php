<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;

class AdminRepository
{

    protected $category;
    protected $product;
    protected $cart;
    protected $order;
    protected $orderitem;

    public function __construct(Category $category, Product $product, Cart $cart, Order $order, OrderItem $orderitem)
    {
        $this->category = $category;
        $this->product = $product;
        $this->cart = $cart;
        $this->order = $order;
        $this->orderitem = $orderitem;

    }

    public function viewcategory($id = null)
    {
        if ($id) {
            return $this->category->find($id);
        } else {
            return $this->category->get();
        }
    }

    public function addcategory($data)
    {
        $category = Category::create([
            'name' => $data['name'],
            'parent_id' => $data['parent_id'],
        ]);

        return $category;
    }


    public function updatecategory($data, $id)
    {
        $category = $this->category->find($id);
        if ($category) {
            $category->update([
                'name' => $data['name'],
                'parent_id' => $data['parent_id'],
            ]);

            return $category;
        } else {
            return response()->json(['message' => 'Category not found.'], 404);
        }

    }

    public function deletecategory($id)
    {
        $category = $this->category->find($id)->delete();
        return $category;

    }


    public function addproduct($data)
    {
        $product = Product::create([
            'name' => $data['name'],
            'category_id' => $data['category_id'],
            'description' => $data['description'],
            'price' => $data['price'],
            // 'image' => $data['image'],
        ]);

        return $product;
    }

    public function viewproduct($id = null)
    {
        if ($id) {
            return $this->product->find($id);
        } else {
            return $this->product->get();
        }


    }

    public function deleteproduct($id)
    {
        $product = $this->product->find($id)->delete();
        return $product;
    }

    public function updateproduct($id, $data)
    {

        $product = $this->product->find($id);
        if ($product) {
            $product->update([
                'name' => $data['name'],
                'category_id' => $data['category_id'],
                'description' => $data['description'],
                'price' => $data['price'],
                // 'image' => $data['image'],
            ]);

            return $product;
        } else {
            return response()->json(['message' => 'Product not found.'], 404);
        }
    }

    public function filterproduct($categoryId)
    {
        $products = $this->product::where('category_id', $categoryId)->get();
        return $products;
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

    public function emptycart($cartitem)
    {
        $cartitem->delete();
        return $cartitem;
    }

    public function updatecart($itemId,$quantity){
        $item = $this->cart->find($itemId);
        $item->update(['quantity' => $quantity]);
        return $item;
    }


}