<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CategoryService;
use Yajra\DataTables\Facades\DataTables;
use App\DataTables\CategoryDataTable;

class CategoryController extends Controller
{
    protected $CategoryService;

    public function __construct(CategoryService $CategoryService)
    {
        $this->CategoryService = $CategoryService;
        $this->middleware('auth');
    }

    public function category()
    {
        $categories = $this->CategoryService->viewcategory();
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

        $category = $this->CategoryService->addcategory($data);
        return redirect()->back()->with('success', 'category added successfully');

    }

    public function viewcategory(CategoryDataTable $dataTable)
    {
        // $categories = $this->CategoryService->viewcategory();

        // if ($request->ajax()) {
        //     $data = $categories;
        //     return Datatables::of($data)
        //         ->addIndexColumn()
        //         ->addColumn('action', function($data){
        //             $actionBtn = '<a href="/admin/editcategory/ '.$data->id.' " id="'.$data->id.'" class="edit btn btn-success btn-sm">Edit</a> 
                    
        //             <a href="" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</a>';
        //             return $actionBtn;
        //         })
        //         ->rawColumns(['action'])
        //         ->make(true);
        // }
 
        return $dataTable->render('admin.viewcategory');
    }


    public function deletecategory($id)
    {

        $this->CategoryService->deletecategory($id);
        return redirect()->back()->with('success', 'category deleted successfully');

    }


    public function editcategory($id)
    {
        $cate = $this->CategoryService->viewcategory($id);
        $categories = $this->CategoryService->viewcategory();
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

        $category = $this->CategoryService->updatecategory($data, $id);
        return redirect('/admin/viewcategory')->with('success', 'category edited successfully');

    }
}
