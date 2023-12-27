<?php

namespace App\Services;

use App\Repositories\ProductRepository;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;
use Illuminate\Support\Facades\Log;
use Exception;

class ProductService{
    protected $ProductRepository;

    public function __construct(ProductRepository $ProductRepository)
    {
        $this->ProductRepository = $ProductRepository;
    }

    public function addproduct($data)
    {
        $product = $this->ProductRepository->addproduct($data);
        return $product;
    }

    public function viewproduct($id = null)
    {
        if ($id) {
            return $this->ProductRepository->viewproduct($id);
            
        } else {
            return $this->ProductRepository->viewproduct();
        }
    }

    public function deleteproduct($id)
    {
        DB::beginTransaction();

        try {
            $product = $this->ProductRepository->deleteproduct($id);

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to delete product data');
        }

        DB::commit();

        return $product;
    }

    public function updateproduct($id, $data)
    {
        DB::beginTransaction();
        try {
            $product = $this->ProductRepository->updateproduct($id, $data);

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to edit product data');
        }

        DB::commit();

        return $product;
    }


    public function filtercategory($categoryId)
    {
        return $this->ProductRepository->filterproduct($categoryId);

    }
}