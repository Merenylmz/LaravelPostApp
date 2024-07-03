<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Mail\ForgotPasswordMail;
use App\Mail\ReportMail;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix("/categories")->group(function(){
    Route::get("/", [CategoryController::class, "getAllCategories"]);
    Route::get("/{id}", [CategoryController::class, "getCategoryById"]);
    Route::post("/", [CategoryController::class, "addCategory"]);
    Route::delete("/{id}", [CategoryController::class, "deleteCategory"]);
    Route::post("/edit/{id}", [CategoryController::class, "updateCategory"]);
});
Route::prefix("/posts")->group(function(){
    Route::get("/", [PostController::class, "getAllPosts"]);
    Route::get("/{id}", [PostController::class, "getPostById"]);
    Route::post("/", [PostController::class, "addPost"]);
    Route::delete("/{id}", [PostController::class, "deletePost"]);
    Route::post("/edit/{id}", [PostController::class, "updatePost"]);
});
Route::prefix("/auth")->group(function(){
    Route::post("/login", [AuthController::class, "login"]);
    Route::post("/register", [AuthController::class, "register"]);
    Route::post("/forgotpassword", [AuthController::class, "forgotPassword"]);
    Route::post("/newpassword/{token}", [AuthController::class, "newPassword"]);
});

Route::get("/den", function(){
    $exitCode = Artisan::call("queue:work");

    if ($exitCode == 0) {
        return response()->json(['message' => 'Queue processed successfully']);
    } else {
        return response()->json(['message' => 'Error processing queue'], 500);
    }
});
