<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Services\CategoryService;
use App\Services\ProductService;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $CategoryService;
    protected $ProductService;

    public function __construct(CategoryService $CategoryService, ProductService $ProductService)
    {
        $this->CategoryService = $CategoryService;
        $this->ProductService = $ProductService;
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = $this->ProductService->viewproduct();
        $categories = $this->CategoryService->viewcategory();
        
        return view('home',compact('products'),compact('categories'));
    }

    public function admin()
    {
        $products = $this->ProductService->viewproduct();
        return view('adminhome', compact('products'));
    }
}
