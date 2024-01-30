<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FruitCategoryController;
use App\Http\Controllers\FruitItemController;
use App\Http\Controllers\InvoiceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:api')->group(function () {
    Route::prefix('fruit-categories')->group(function () {
        Route::get('/', [FruitCategoryController::class, 'index']);
        Route::get('/{fruitCategory}', [FruitCategoryController::class, 'show']);
        Route::post('/', [FruitCategoryController::class, 'store']);
        Route::patch('/{fruitCategory}', [FruitCategoryController::class, 'update']);
        Route::delete('/{fruitCategory}', [FruitCategoryController::class, 'destroy']);
    });

    Route::prefix('fruit-items')->group(function () {
        Route::get('/', [FruitItemController::class, 'index']);
        Route::get('/{fruitItem}', [FruitItemController::class, 'show']);
        Route::post('/', [FruitItemController::class, 'store']);
        Route::patch('/{fruitItem}', [FruitItemController::class, 'update']);
        Route::delete('/{fruitItem}', [FruitItemController::class, 'destroy']);
    });

    Route::prefix('invoices')->group(function () {
        Route::post('/', [InvoiceController::class, 'store']);
        Route::get('/', [InvoiceController::class, 'index']);
        Route::get('/{invoice}', [InvoiceController::class, 'show']);
        Route::patch('/{invoice}', [InvoiceController::class, 'update']);
        Route::delete('/{invoice}', [InvoiceController::class, 'destroy']);
        Route::get('generate-pdf/{invoice}', [InvoiceController::class, 'generatePdf']);
    });
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);
});
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
