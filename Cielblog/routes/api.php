<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\ArticleController;
use App\Http\Controllers\API\Save_blogController;
use App\Http\Controllers\API\AccountController;

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
Route::apiResource("articles", ArticleController::class);
Route::apiResource("save_blogs", Save_blogController::class);
Route::apiResource("accounts", AccountController::class);
Route::get('/accounts', [AccountController::class, 'index']);
Route::get('logout', [AccountController::class, 'logout']);
