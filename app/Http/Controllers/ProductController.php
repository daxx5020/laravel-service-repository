<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Services\CategoryService;

class ProductController extends Controller
{

    protected $ProductService;
    protected $CategoryService;

    public function __construct(ProductService $ProductService, CategoryService $CategoryService)
    {
        $this->ProductService = $ProductService;
        $this->CategoryService = $CategoryService;
        $this->middleware('auth');
    }
    public function product()
    {
        $categories = $this->CategoryService->viewcategory();
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

        $imagePath = $request->file('image')->store('product_images', 'public');

        $data = $request->only([
            'name',
            'description',
            'price',
            'category_id',
            'image',
        ]);

        $this->ProductService->addproduct($data, $imagePath);
        return redirect()->back()->with('success', 'product added successfully');
    }

    public function deleteproduct($id)
    {
        $this->ProductService->deleteproduct($id);
        return redirect()->back()->with('success', 'product deleted successfully');

    }

    public function editproduct($id){
        $prod = $this->ProductService->viewproduct($id);
        $categories = $this->CategoryService->viewcategory();
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

        $imagePath = $request->file('image')->store('product_images', 'public');

        $data = $request->only([
            'name',
            'description',
            'price',
            'category_id',
            'image',
        ]);

        $this->ProductService->updateproduct($id,$data, $imagePath);
        return redirect('/admin/home')->with('success', 'product edited successfully');

    }

    public function filterproduct(Request $request){
        $categoryId = $request->input('category_id');

        if ($categoryId) {

        $products = $this->ProductService->filtercategory($categoryId);
        return response()->json($products);
    }

    return response()->json([]);

    }
}
