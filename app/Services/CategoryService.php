<?php

namespace App\Services;

use App\Repositories\CategoryRepository;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;
use Illuminate\Support\Facades\Log;
use Exception;

class CategoryService{

    protected $CategoryRepository;


    public function __construct(CategoryRepository $CategoryRepository)
    {
        $this->CategoryRepository = $CategoryRepository;
    }

    public function viewcategory($id = null)
    {
        if ($id) {
            return $this->CategoryRepository->viewcategory($id);
        } else {
            return $this->CategoryRepository->viewcategory();
        }
    }

    public function addcategory($data)
    {

        $category = $this->CategoryRepository->addcategory($data);
        return $category;
    }

    public function deletecategory($id)
    {
        DB::beginTransaction();

        try {
            $category = $this->CategoryRepository->deletecategory($id);

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to delete category data');
        }

        DB::commit();

        return $category;
    }


    public function updatecategory($data, $id)
    {
        DB::beginTransaction();
        try {
            $category = $this->CategoryRepository->updatecategory($data, $id);

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to edit category data');
        }

        DB::commit();

        return $category;

    }
}