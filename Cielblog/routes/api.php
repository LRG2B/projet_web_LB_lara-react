<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\ArticleController;
use App\Http\Controllers\API\Save_blogController;
use App\Http\Controllers\API\AccountController;

use App\Http\Controllers\API\AuthController;

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
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/me', [AuthController::class, 'me'])->middleware('auth:sanctum');
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');


 
Route::apiResource("categories", CategoryController::class)->middleware('auth:sanctum');
Route::get('categories', [CategoryController::class, 'get_categories']);

Route::apiResource("articles", ArticleController::class)->middleware('auth:sanctum');
Route::post("articles/add", [ArticleController::class, 'add'])->middleware('auth:sanctum');
Route::get("articles", [ArticleController::class, 'get_articles'])->middleware('auth:sanctum');

Route::apiResource("save_blogs", Save_blogController::class)->middleware('auth:sanctum');