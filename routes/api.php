<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Models\Category;
use App\Http\Resources\ProductResource;
use App\Http\Controllers\OtpController;
use App\Http\Resources\CategoryResource;
use App\Http\Controllers\OrderController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('api')->group(function () {
    Route::get('/products', function () {
        return ProductResource::collection(Product::with('category')->get());
    });

    Route::get('/categories', function () {
        return CategoryResource::collection(Category::all());
    });

    Route::post('/orders', [OrderController::class, 'store']);
});

// Route::post('/request-otp', [OtpController::class, 'requestOtp']);

