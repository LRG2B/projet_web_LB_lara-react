<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\AccountController;
use App\Http\Controllers\API\ArticleController;
use App\Http\Controllers\API\Save_blogController;

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

Route::apiResource("categories", CategoryController::class);
Route::apiResource("account", AccountController::class);
Route::apiResource("articles", ArticleController::class);
Route::apiResource("save_blog", Save_blogController::class);
