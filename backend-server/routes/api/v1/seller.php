<?php

use App\Http\Controllers\Api\Seller\SellerAuthController;
use App\Http\Controllers\Api\Seller\SellerController;
use Illuminate\Support\Facades\Route;

Route::controller(SellerAuthController::class)->group(function () {
    Route::post('/login', 'login');
    Route::post('/register', 'register');
});

// Route::controller(SellerController::class)->group(function () {
//     Route::post('/apply', 'sellerApply');
// });




Route::middleware('auth:seller-api')->group(function () {
    Route::controller(SellerAuthController::class)->group(function () {
        Route::post('/logout', 'logout');
        Route::get('/me',  'user');
    });
});
