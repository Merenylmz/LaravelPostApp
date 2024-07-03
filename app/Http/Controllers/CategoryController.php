<?php

namespace App\Http\Controllers;

use App\Interfaces\ICategoryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CategoryController extends Controller
{
    private $categoryRepository;
    public function __construct(ICategoryRepository $categoryRepository) {
        $this->categoryRepository = $categoryRepository;
    }

    public function getAllCategories(Request $req) {
        try {
            $categories = [];
            if (!Cache::has("allcat")) {
                $categories = $this->categoryRepository->getAll();
                Cache::put("allcat", $categories, 60*60);
            } else {
                $categories = Cache::get("allcat");
            }
            
            return response()->json($categories);
        } catch (\Throwable $th) {
            return response()->json(["status"=>"Is Not OK", "error"=>$th->getMessage()]);
        }
    }

    
    public function getCategoryById(Request $req, $id) {
        try {
            $category = $this->categoryRepository->getById($id);

            return response()->json($category);
        } catch (\Throwable $th) {
            return response()->json(["status"=>"Is Not OK", "error"=>$th->getMessage()]);
        }
    }

    public function addCategory(Request $req) {
        try {
            $status = $this->categoryRepository->create($req->all());
            if (Cache::has("allcat")) {
                Cache::forget("allcat");
            }

            return response()->json($status);
        } catch (\Throwable $th) {
            return response()->json(["status"=>"Is Not OK", "error"=>$th->getMessage()]);
        }
    }

    public function deleteCategory(Request $req, $id) {
        try {
            $status = $this->categoryRepository->delete($id);
            if (Cache::has("allcat")) {
                Cache::forget("allcat");
            }

            return response()->json($status);
        } catch (\Throwable $th) {
            return response()->json(["status"=>"Is Not OK", "error"=>$th->getMessage()]);
        }
    }

    public function updateCategory(Request $req, $id) {
        try {
            $status = $this->categoryRepository->update($id, $req->all());

            return response()->json($status);
        } catch (\Throwable $th) {
            return response()->json(["status"=>"Is Not OK", "error"=>$th->getMessage()]);
        }
    }

    public function getPostByCategoryId(Request $req, $id) {
        try {
            $status = $this->categoryRepository->getPostByCategory($id);

            return response()->json($status);
        } catch (\Throwable $th) {
            return response()->json(["status"=>"Is Not OK", "error"=>$th->getMessage()]);
        }
    }
}
