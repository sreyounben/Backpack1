<?php
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\TagController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\TrainerController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CustomerController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//filter Search
Route::get("/search/{title}",[PostController::class,'search']);
Route::get('/search-data/{name}',[ProductController::class,'searchName']);
Route::get("/search/{title}",[CategoryController::class,'search']);
Route::get("/Content/{content}",[ArticleController::class,'Content']);

Route::get('/articles', [ArticleController::class,'index']);
Route::post('/article', [ArticleController::class, 'store']);
Route::get('/article/{id}', [ArticleController::class,'show']);
Route::put('/article/{id}', [ArticleController::class, 'update']);
Route::delete('/articles/{id}', [ArticleController::class, 'destroy']);

Route::get('users',[UserController::class, 'index']);
Route::get('user/{id}',[UserController::class, 'show']);
Route::post('user',[UserController::class, 'store']);
Route::put('user/{id}',[UserController::class, 'update']);
Route::delete('user/{id}',[UserController::class, 'destroy']);

Route::get('trainers',[TrainerController::class, 'index']);
Route::get('trainer/{id}',[TrainerController::class, 'show']);
Route::post('trainer',[TrainerController::class, 'store']);
Route::put('trainer/{id}',[TrainerController::class, 'update']);
Route::delete('trainer/{id}',[TrainerController::class, 'destroy']);

Route::get('tags',[TagController::class, 'index']);
Route::post('tag',[TagController::class, 'store']);
Route::get('tags/{id}',[TagController::class, 'show']);
Route::put('tags/{id}',[TagController::class, 'update']);
Route::delete('tags/{id}',[TagController::class, 'destroy']);

Route::get('customers',[CustomerController::class, 'index']);
Route::post('customer',[CustomerController::class, 'store']);
Route::get('customers/{id}',[CustomerController::class, 'show']);
Route::post('customers/{id}',[CustomerController::class, 'update']);
Route::delete('customers/{id}',[CustomerController::class, 'destroy']);

Route::get('contacts',[ContactController::class, 'index']);
Route::post('contact',[ContactController::class, 'store']);
Route::get('contact/{id}',[ContactController::class, 'show']);
Route::put('contact/{id}',[ContactController::class, 'update']);
Route::delete('contact/{id}',[ContactController::class, 'destroy']);

Route::get('products',[ProductController::class, 'index']);
Route::post('product',[ProductController::class, 'store']);
Route::get('products/{id}',[ProductController::class, 'show']);
Route::post('/products/{id}',[ProductController::class, 'update']);
Route::delete('products/{id}',[ProductController::class, 'destroy']);

Route::get('posts',[PostController::class, 'index']);
Route::post('post',[PostController::class, 'store']);
Route::get('posts/{id}',[PostController::class, 'show']);
Route::post('/posts/{id}',[PostController::class, 'update']);
Route::delete('posts/{id}',[PostController::class, 'destroy']);

