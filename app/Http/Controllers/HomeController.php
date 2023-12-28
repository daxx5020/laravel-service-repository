<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Services\CategoryService;
use App\Services\ProductService;
use App\DataTables\ProductsDataTable;

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

    public function admin(ProductsDataTable $dataTable)
    {
        
        return $dataTable->render('adminhome');
        // $products = $this->ProductService->viewproduct();
        // if ($request->ajax()) {
        //     $data = $products;
        //     return Datatables::of($data)
        //         ->addIndexColumn()
        //         ->addColumn('action', function($data){
        //             $actionBtn = '<a href="/admin/editproduct/ '.$data->id.' " id="'.$data->id.'" class="edit btn btn-success btn-sm">Edit</a> 
                    
        //             <a href="" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</a>';
        //             return $actionBtn;
        //         })
        //         ->rawColumns(['action'])
        //         ->make(true);
        // }
 
        // return view('adminhome');
    }
}
