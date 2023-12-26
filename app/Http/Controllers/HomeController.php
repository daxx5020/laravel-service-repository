<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AdminService;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = $this->adminService->viewproduct();
        $categories = $this->adminService->viewcategory();
        
        return view('home',compact('products'),compact('categories'));
    }

    public function admin()
    {
        $products = $this->adminService->viewproduct();
        return view('adminhome', compact('products'));
    }

    public function category()
    {
        $categories = $this->adminService->viewcategory();
        return view('admin.category', compact('categories'));
    }

    public function storecategory(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        $data = $request->only([
            'name',
            'parent_id',
        ]);

        $category = $this->adminService->addcategory($data);
        return redirect()->back()->with('success', 'category added successfully');

    }

    public function viewcategory()
    {
        $categories = $this->adminService->viewcategory();
        return view('admin.viewcategory', compact('categories'));
    }


    public function deletecategory($id)
    {

        $this->adminService->deletecategory($id);
        return redirect()->back()->with('success', 'category deleted successfully');

    }


    public function editcategory($id)
    {
        $cate = $this->adminService->viewcategory($id);
        $categories = $this->adminService->viewcategory();
        return view('admin.category', compact('cate'), compact('categories'));
    }

    public function updatecategory(Request $request, $id)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
        ]);


        $data = $request->only([
            'name',
            'parent_id',
        ]);

        $category = $this->adminService->updatecategory($data, $id);
        return redirect('/admin/viewcategory')->with('success', 'category edited successfully');

    }

    public function product()
    {
        $categories = $this->adminService->viewcategory();
        return view('admin.product', compact('categories'));

    }

    public function storeproduct(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        $data = $request->only([
            'name',
            'description',
            'price',
            'category_id',
            // 'image',
        ]);

        $product = $this->adminService->addproduct($data);
        return redirect()->back()->with('success', 'product added successfully');
    }

    public function deleteproduct($id)
    {
        $this->adminService->deleteproduct($id);
        return redirect()->back()->with('success', 'product deleted successfully');

    }

    public function editproduct($id){
        $prod = $this->adminService->viewproduct($id);
        $categories = $this->adminService->viewcategory();
        return view('admin.product', compact('prod'), compact('categories'));

    }

    public function updateproduct(Request $request,$id){

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        $data = $request->only([
            'name',
            'description',
            'price',
            'category_id',
            // 'image',
        ]);

        $product = $this->adminService->updateproduct($id,$data);
        return redirect('/admin/home')->with('success', 'product edited successfully');

    }

    public function filterproduct(Request $request){
        $categoryId = $request->input('category_id');

        if ($categoryId) {

        $products = $this->adminService->filtercategory($categoryId);
        return response()->json($products);
    }

    return response()->json([]);

    }

    public function cart(){
        $userId = auth()->id();
        $cartItems = $this->adminService->cartitem($userId);
        $total = $this->adminService->total($userId);

        return view('user.cart',compact('cartItems','total'));
    }

    public function addtocart(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');

        $existingCartItem = $this->adminService->existingCartItem($productId);

        if ($existingCartItem) {
             $this->adminService->quantityadd($productId,$quantity);
        } else {
            $this->adminService->cartadd($productId,$quantity);
        }

        return response()->json(['message' => 'Product added to cart successfully']);        
    }


    public function removecart($id){

        $this->adminService->removecart($id);
        return redirect()->back()->with('success', 'product removed successfully');
    }

    public function checkout(){
        $userId = auth()->id();
        $total = $this->adminService->total($userId);
        $cartItems = $this->adminService->cartitem($userId);

        $order = $this->adminService->ordercreate($userId,$total);

        foreach ($cartItems as $cartItem) {
           $this->adminService->orderitemcreate($order,$cartItem);
            $this->adminService->emptycart($cartItem);
        }

        return redirect()->route('home')->with('success', 'Order placed successfully!');
    }

    public function orders(){
        $id = auth()->id();
        $orders = $this->adminService->order($id);
        return view('user.order', compact('orders'));
    }
}
