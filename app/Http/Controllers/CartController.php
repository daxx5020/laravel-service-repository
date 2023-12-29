<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CartService;
use App\Services\OrderService;
use App\Jobs\SendOrderConfirmationEmail;


class CartController extends Controller
{

    protected $CartService;
    protected $OrderService;

    public function __construct(CartService $CartService, OrderService $OrderService)
    {
        $this->CartService = $CartService;
        $this->OrderService = $OrderService;
        $this->middleware('auth');
    }


    public function cart(){
        $userId = auth()->id();
        $cartItems = $this->CartService->cartitem($userId);
        $total = $this->CartService->total($userId);

        return view('user.cart',compact('cartItems','total'));
    }

    public function addtocart(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');

        $existingCartItem = $this->CartService->existingCartItem($productId);

        if ($existingCartItem) {
             $this->CartService->quantityadd($productId,$quantity);
        } else {
            $this->CartService->cartadd($productId,$quantity);
        }

        return response()->json(['message' => 'Product added to cart successfully']);
    }


    public function removecart($id){

        $this->CartService->removecart($id);
        return redirect()->back()->with('success', 'product removed successfully');
    }

    public function checkout(){
        $userId = auth()->id();
        $total = $this->CartService->total($userId);
        $cartItems = $this->CartService->cartitem($userId);

        $order = $this->OrderService->ordercreate($userId,$total);

        foreach ($cartItems as $cartItem) {
           $this->OrderService->orderitemcreate($order,$cartItem);
            $this->CartService->emptycart($cartItem);
        }
        
        SendOrderConfirmationEmail::dispatch($order);

        return redirect()->route('home')->with('success', 'Order placed successfully!');
    }
}
