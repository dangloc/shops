<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Admin\Users\LoginController;
use \App\Http\Controllers\Admin\MainController;
use \App\Http\Controllers\Admin\MenuController;
use \App\Http\Controllers\Admin\ProductController;
use \App\Http\Controllers\Admin\SliderController;

use GuzzleHttp\Handler\Proxy;

Route::get('admin/users/login', [LoginController::class,'index'])->name('login');
Route::post('admin/users/login/store',[LoginController::class,'store']);

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


        #Upload
        Route::post('upload/services', [\App\Http\Controllers\Admin\UploadController::class, 'store']);


                #slider
                Route::prefix('sliders')->group(function (){
                    Route::get('add', [SliderController::class, 'create']);
                    Route::get('list', [SliderController::class, 'index']);
                    Route::post('add', [SliderController::class, 'store']);
                    // Route::get('edit/{slider}', [SliderController::class, 'show']);
                    // Route::post('edit/{slider}', [SliderController::class, 'update']);
                    // Route::DELETE('destroy', [SliderController::class, 'destroy']);
                });
    });
});
