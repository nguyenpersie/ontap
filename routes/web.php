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

Route::get('login',[LoginController::class,'index'])->name('login');

Route::post('admin/users/login',[LoginController::class,'login'])->name('postLogin');

Route::post('admin/users/register',[LoginController::class,'postRegistration'])->name('postRegister');

Route::post('change-password', [LoginController::class, 'updatePassword'])->name('update-password');


Route::get('logout',[LoginController::class,'logout'])->name('logout');



Route::prefix('admin')->middleware('auth')->group(function () {
    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class,'index'])->name('user.list');
        Route::post('/postCreate', [UserController::class,'postCreate'])->name('user.add.post');
        Route::get('/editUser/{id}', [UserController::class,'ShowUser'])->name('user.edit');
        Route::post('/updateUser/{id}', [UserController::class,'updateUser'])->name('user.update.post');
        Route::get('/destroy/{id}', [UserController::class,'destroy'])->name('user.delete');
        Route::get('/search',[UserController::class,'search'])->name('user.search');
    });

    Route::prefix('customers')->middleware('auth')->group(function(){
        Route::get('/', [CustomerController::class,'index'])->name('customer.list');
        Route::post('/postCreate',[CustomerController::class,'postCreate'])->name('customer.add.post');
        Route::get('/editCustomer/{id}',[CustomerController::class,'showCustomer'])->name('customer.edit');
        // Route::post('/updateCustomer/{id}',[CustomerController::class,'updateCustomer'])->name('customer.update.post');
        Route::post('/update', [CustomerController::class, 'update'])->name('customer.post.update');
        Route::get('/customer/{id}/edit', [CustomerController::class, 'editCustomer']);
        Route::get('/exportCustomers', [CustomerController::class, 'export'])->name('customers.export');
        Route::post('/importCustomers', [CustomerController::class, 'import'])->name('customers.import');
        Route::get('/search',[CustomerController::class,'cusSearch'])->name('customers.search');
    });

    Route::prefix('products')->middleware('auth')->group(function(){
        Route::get('/', [ProductController::class,'index'])->name('product.list');
        Route::post('/postCreate',[ProductController::class,'postCreate'])->name('product.add.post');
        Route::post('/updateProduct/{id}',[ProductController::class,'updateProduct'])->name('product.update.post');
        Route::get('/deleteProduct/{id}',[ProductController::class,'deleteProduct'])->name('product.delete');
        Route::get('/search',[ProductController::class,'proSearch'])->name('products.search');

        Route::get('/editProduct/{id}', [ProductController::class,'ShowProduct'])->name('product.edit');
    });

});

