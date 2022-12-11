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
Route::post('/me', [AuthController::class, 'me'])->middleware('auth:sanctum');


Route::apiResource("categories", CategoryController::class);
Route::apiResource("articles", ArticleController::class);
Route::apiResource("save_blogs", Save_blogController::class);
Route::apiResource("accounts", AccountController::class);