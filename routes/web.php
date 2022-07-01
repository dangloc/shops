<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Admin\Users\LoginController;
use \App\Http\Controllers\Admin\MainController;

Route::get('admin/users/login', [LoginController::class,'index'])->name('login');
Route::post('admin/users/login/store',[LoginController::class,'store']);

Route::middleware(['auth'])->group(function () {
    Route::get('admin', [MainController::class, 'index'])->name('admin');
    Route::get('admin/main', [MainController::class, 'index']);
});
