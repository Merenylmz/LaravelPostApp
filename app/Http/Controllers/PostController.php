<?php

namespace App\Http\Controllers;

use App\Interfaces\IPostRepository;
use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private $postRepository;
    public function __construct(IPostRepository $postRepository) {
        $this->postRepository = $postRepository;
    }
    public function getAllPosts(Request $request){
        try {
            $status = $this->postRepository->getAll();

            return response()->json($status);
        } catch (\Throwable $th) {
            return response()->json(["status"=>"Is Not OK", "error"=>$th]);
        }
    }

    public function getPostById($id){
        try {
            $status = $this->postRepository->getById($id);
            return response()->json($status);
        } catch (\Throwable $th) {
            return response()->json(["status"=>"Is Not OK", "error"=>$th]);
        }
    }

    public function addPost(Request $request){
        try {
            $status = $this->postRepository->create($request->all());

            return response()->json($status);
        } catch (\Throwable $th) {
            return response()->json(["status"=>"Is Not OK", "error"=>$th]);
        }
    }

    public function deletePost($id){
        try {
            $status = $this->postRepository->delete($id);

            return response()->json($status);
        } catch (\Throwable $th) {
            return response()->json(["status"=>"Is Not OK", "error"=>$th]);
        }
    }
    public function updatePost(Request $req, $id){
        try {
            $status = $this->postRepository->update($id, $req->all());

            return response()->json($status);
        } catch (\Throwable $th) {
            return response()->json(["status"=>"Is Not OK", "error"=>$th]);
        }
    }
}
