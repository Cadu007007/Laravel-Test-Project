<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserAuthController;
use App\Http\Controllers\Api\AdminAuthController;
use App\Http\Controllers\Api\Admin\ItemController;
use App\Http\Controllers\Api\User\ItemController as UserItemController;
use App\Http\Controllers\Api\Admin\UserController;
use App\Http\Controllers\Api\Admin\StorageController;

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

Route::group(['prefix' => 'user/auth'], function () {
    Route::post('/login', [UserAuthController::class, 'login']);
    Route::post('/register', [UserAuthController::class, 'register']);
    Route::post('/logout', [UserAuthController::class, 'logout']);
    Route::post('/refresh', [UserAuthController::class, 'refresh']);
    Route::get('/user-profile', [UserAuthController::class, 'userProfile']);    
});
Route::group(['prefix' => 'admin/auth'], function () {
    Route::post('/login', [AdminAuthController::class, 'login']);
    Route::post('/register', [AdminAuthController::class, 'register']);
    Route::post('/logout', [AdminAuthController::class, 'logout']);
    Route::post('/refresh', [AdminAuthController::class, 'refresh']);
    Route::get('/admin-profile', [AdminAuthController::class, 'adminProfile']);    
});
Route::group(['prefix' => 'users'], function () {
    Route::get('/', [UserController::class, 'index']);
    Route::post('/', [UserController::class, 'store']);
    Route::put('update/{user}', [UserController::class, 'update']);
    Route::delete('delete/{user}', [UserController::class, 'destroy']);
});
Route::group(['prefix' => 'storages'], function () {
    Route::get('/', [StorageController::class, 'index']);
    Route::post('/', [StorageController::class, 'store']);
    Route::put('update/{storage}', [StorageController::class, 'update']);
    Route::delete('delete/{storage}', [StorageController::class, 'destroy']);
});
Route::group(['prefix' => 'admin/items'], function () {
    Route::get('/', [ItemController::class, 'index']);
    Route::post('/', [ItemController::class, 'store']);
    Route::post('update/', [ItemController::class, 'update']);
    Route::delete('delete/{id}', [ItemController::class, 'destroy']);
});
Route::group(['prefix' => 'users/items'], function () {
    Route::get('/get-all-Items', [UserItemController::class, 'index']);
    Route::get('add-item/{id}', [UserItemController::class, 'store']);
  
});
