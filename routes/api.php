<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

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

Route::post('/login', [UserController::class, 'login'])->name('login');
Route::post('/register', [UserController::class, 'store'])->name('register');

// For Unauthorized
Route::get('/Unauthorized', function () {
    return response()->json(['message' => "Unauthorized, Please login to access this page!"], Response::HTTP_UNAUTHORIZED);
})->name('unauthorized');

Route::group(['middleware' => ['auth:api', 'localization']], function () {
    // User Actions
    Route::group(['prefix' => 'user'], function () {
        Route::get('/profile', [UserController::class, 'profile']);
        Route::post('/logout', [UserController::class, 'logout']);
    });

    // Store Actions
    Route::group(['prefix' => 'store'], function () {
        Route::group(['middleware' => 'user.store'], function () {
            Route::get('/', [StoreController::class, 'index']);
            Route::post('/update', [StoreController::class, 'update']);
        });

        Route::post('/create', [StoreController::class, 'store']);
        Route::get('/{slug}', [StoreController::class, 'show']);
    });

    // Product Actions
    Route::group(['prefix' => 'product'], function () {
        Route::group(['middleware' => 'user.store'], function () {
            Route::post('/create', [ProductController::class, 'store']);
        });
        Route::get('/list', [ProductController::class, 'index']);
        Route::get('/{id}', [ProductController::class, 'show']);
    });

    Route::get('/categories', [CategoryController::class, 'index']);
});
