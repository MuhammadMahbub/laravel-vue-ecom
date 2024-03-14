<?php

use App\Http\Controllers\Api\Admin\CouponController;
use App\Http\Controllers\Api\Admin\DivisionController;
use App\Http\Controllers\Api\User\AuthController;
use App\Http\Controllers\Api\User\ProfileController;
use App\Http\Controllers\Api\User\WishlistController;
use Illuminate\Support\Facades\Route;



/*
|--------------------------------------------------------------------------
| User or customer AuthController
|--------------------------------------------------------------------------
*/

Route::controller(AuthController::class)->group(function () {
    Route::post('/login', 'login');
    Route::post('/register', 'register');
    // Route::post('/otp-verify', 'verifyOtp');
    // Route::post('/otp-resend', 'otpResend');
});


Route::middleware('auth:user-api')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::post('/logout', 'logout');
        Route::get('/me',  'user');

        // Route::get('/address', 'address');
        // Route::post('/address/store', 'addressStore');
    });






    /*
|--------------------------------------------------------------------------
| User or customer Diviso fetch
|--------------------------------------------------------------------------
*/

    // Route::controller(DivisionController::class)->group(function () {
    //     Route::get('divisions', 'index');
    //     Route::get('district/{division}',  'districtById');
    // });


    /*
|--------------------------------------------------------------------------
| User wishlist
|--------------------------------------------------------------------------
*/

    // Route::apiResources([
    //     'wishlists' => WishlistController::class,
    // ]);


    // Route::post('/apply-coupon', [CouponController::class, 'apply']);



    // Route::controller(ProfileController::class)->group(function () {

    //     Route::get('/orders', 'orders');
    //     Route::get('/order/{order}',  'orderById');
    //     Route::post('/profile-update',  'updateProfile');
    //     Route::post('/image-update',  'updateImage');
    //     Route::put('/password-update',  'updatePassword');
    // });
});
