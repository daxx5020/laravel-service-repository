<?php

namespace App\Services;
use App\Repositories\AdminRepository;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;
use Illuminate\Support\Facades\Log;
use Exception;


class AdminService{

    protected $adminRepository;


    public function __construct(AdminRepository $adminRepository){
        $this->adminRepository = $adminRepository;
    }

    public function viewcategory($id = null){
        
        if ($id) {
            return $this->adminRepository->viewcategory($id);
        } else {
            return $this->adminRepository->viewcategory();
        }
        
        
    }


    public function addcategory($data){

        $category = $this->adminRepository->addcategory($data);
        return $category;
    }

    public function deletecategory($id){
        DB::beginTransaction();

        try {
            $category = $this->adminRepository->deletecategory($id);

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to delete post data');
        }

        DB::commit();

        return $category;
    }


    public function updatecategory($data,$id){
        DB::beginTransaction();
        try {
            $category = $this->adminRepository->updatecategory($id,$data);

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to edit category data');
        }

        DB::commit();

        return $category;

    }

}