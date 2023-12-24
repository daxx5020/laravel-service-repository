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
        return view('home');
    }

    public function admin()
    {
        return view('adminhome');
    }

    public function category(){
        $categories = $this->adminService->viewcategory();
        return view('admin.category',compact('categories'));
    }

    public function storecategory(Request $request){
        $data = $request->only([
            'name',
            'parent_id',
        ]);

        $category = $this->adminService->addcategory($data);
        return redirect()->back()->with('success','category add successfully');



    }

    public function viewcategory(){
        $categories = $this->adminService->viewcategory();
        return view('admin.viewcategory',compact('categories'));
    }


    public function deletecategory($id){
        
        $this->adminService->deletecategory($id);
        return redirect()->back()->with('success','category deleted successfully');

    }


    public function editcategory($id){
        $cate = $this->adminService->viewcategory($id);
        $categories = $this->adminService->viewcategory();
        return view('admin.category',compact('cate'),compact('categories'));
    }

    public function updatecategory(Request $request,$id){

        $data = $request->only([
            'name',
            'parent_id',
        ]);

        $category = $this->adminService->updatecategory($data, $id);
        return redirect('/admin/viewcategory')->with('success','category edited successfully');

    }
}
