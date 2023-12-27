<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository{
    protected $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
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
}