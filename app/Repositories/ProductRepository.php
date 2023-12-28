<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository{

    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function addproduct($data, $imagePath)
    {
        $product = Product::create([
            'name' => $data['name'],
            'category_id' => $data['category_id'],
            'description' => $data['description'],
            'price' => $data['price'],
            'image' => $imagePath,
        ]);

        return $product;
    }

    public function viewproduct($id = null)
    {
        if ($id) {
            return $this->product->find($id);
        } else {
            return $this->product::with('category')->get();
        }
    }

    public function deleteproduct($id)
    {
        $product = $this->product->find($id)->delete();
        return $product;
    }

    public function updateproduct($id, $data, $imagePath)
    {

        $product = $this->product->find($id);
        if ($product) {
            $product->update([
                'name' => $data['name'],
                'category_id' => $data['category_id'],
                'description' => $data['description'],
                'price' => $data['price'],
                'image' => $imagePath,
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
    
}