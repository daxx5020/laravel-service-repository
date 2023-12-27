<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CategoryService;

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

    public function viewcategory()
    {
        $categories = $this->CategoryService->viewcategory();
        return view('admin.viewcategory', compact('categories'));
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
