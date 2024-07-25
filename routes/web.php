<?php

use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Users\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('admin/users/login',[LoginController::class,'index']);

Route::post('admin/users/login',[LoginController::class,'login']);

Route::get('logout',[LoginController::class,'logout']);

Route::prefix('admin')->group(function () {
    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class,'index'])->name('user.list');
        Route::post('/postCreate', [UserController::class,'postCreate'])->name('user.add.post');
        Route::get('/editUser/{id}', [UserController::class,'show'])->name('user.edit');
        Route::post('/updateUser/{id}', [UserController::class,'updateUser'])->name('user.update.post');
        Route::get('/destroy/{id}', [UserController::class,'destroy'])->name('user.delete');
    });

    Route::prefix('customers')->group(function(){
        Route::get('/', [CustomerController::class,'index'])->name('customer.list');
        Route::post('/postCreate',[CustomerController::class,'postCreate'])->name('customer.add.post');
        Route::get('/editCustomer/{id}',[CustomerController::class,'showEdit'])->name('customer.edit');
        Route::post('/updateCustomer/{id}',[CustomerController::class,'updateCustomer'])->name('customer.update.post');
        Route::get('/exportCustomers', [CustomerController::class, 'export'])->name('customers.export');
        Route::get('/importCustomers', [CustomerController::class, 'import'])->name('customers.import');
    });

    Route::prefix('products')->group(function(){
        Route::get('/', [ProductController::class,'index'])->name('product.list');
        Route::post('/postCreate',[ProductController::class,'postCreate'])->name('product.add.post');
        Route::get('/editProduct/{id}',[ProductController::class,'ShowProduct'])->name('product.edit');
        Route::post('/updateProduct/{id}',[ProductController::class,'updateProduct'])->name('product.update.post');
        Route::get('/deleteProduct/{id}',[ProductController::class,'deleteProduct'])->name('product.delete');
    });

});

