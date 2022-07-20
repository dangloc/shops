<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Users\LoginController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\UserController;

use GuzzleHttp\Handler\Proxy;

Route::get('auth/login', [UserController::class, 'login']);
Route::post('auth/login/store', [UserController::class, 'store']);
Route::get('auth/register', [UserController::class, 'register']);
Route::post('auth/register/storeRegister', [UserController::class, 'storeRegister']);
Route::get('auth/logout', [UserController::class, 'logout']);


Route::get('admin/users/login', [LoginController::class,'index'])->name('login');
Route::post('admin/users/login/store',[LoginController::class,'store']);
Route::get('admin/users/logout', [LoginController::class, 'logout']);

Route::middleware(['auth'])->group(function () {
    
    #admin
    Route::prefix('admin')->group(function () {

        Route::get('/', [MainController::class, 'index'])->name('admin');
        Route::get('main', [MainController::class, 'index']);

        #menu
        Route::prefix('menus')->group(function (){
            Route::get('add', [MenuController::class, 'create']);
            Route::post('add', [MenuController::class, 'store']);
            Route::get('list', [MenuController::class, 'index']);
            Route::get('edit/{menu}', [MenuController::class, 'show']);
            Route::post('edit/{menu}', [MenuController::class, 'update']);
            Route::DELETE('destroy', [MenuController::class, 'destroy']);
        }) ;

        #product
        Route::prefix('products')->group(function (){
            Route::get('list', [ProductController::class, 'index']);
            Route::get('add', [ProductController::class, 'create']);
            Route::post('add', [ProductController::class, 'store']);
            Route::get('edit/{product}', [ProductController::class, 'show']);
            Route::post('edit/{product}', [ProductController::class, 'update']);
            Route::DELETE('destroy', [ProductController::class, 'destroy']);
        });

         #slider
         Route::prefix('sliders')->group(function (){
            Route::get('add', [SliderController::class, 'create']);
            Route::get('list', [SliderController::class, 'index']);
            Route::post('add', [SliderController::class, 'store']);
            Route::get('edit/{slider}', [SliderController::class, 'show']);
            Route::post('edit/{slider}', [SliderController::class, 'update']);
            Route::DELETE('destroy', [SliderController::class, 'destroy']);
        });


        #Upload
        Route::post('upload/services', [\App\Http\Controllers\Admin\UploadController::class, 'store']);

        #cart
        Route::get('customers', [\App\Http\Controllers\Admin\CartController::class, 'index']);
        Route::get('customers/view/{customer}', [\App\Http\Controllers\Admin\CartController::class, 'show']);
        
    });
});

Route::get('/', [App\Http\Controllers\MainController::class, 'index']);
Route::post('/services/load-product', [App\Http\Controllers\MainController::class, 'loadProduct']);


Route::get('category/{id}-{slug}.html', [App\Http\Controllers\MenuController::class, 'index']);
Route::get('product/{id}-{slug}.html', [App\Http\Controllers\ProductController::class, 'index']);

Route::post('add-cart', [App\Http\Controllers\CartController::class, 'index']);
Route::get('carts', [App\Http\Controllers\CartController::class, 'show']);
Route::post('update-cart', [App\Http\Controllers\CartController::class, 'update']);
Route::get('carts/delete/{id}', [App\Http\Controllers\CartController::class, 'remove']);
Route::post('carts', [App\Http\Controllers\CartController::class, 'addCart']);
