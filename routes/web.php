<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;


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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::middleware(['role:1'])->group(function () {
    Route::get('/admin/home', [App\Http\Controllers\HomeController::class, 'admin'])->name('admin.home');
    Route::get('/admin/category', [App\Http\Controllers\CategoryController::class, 'category'])->name('category');
    Route::post('/admin/category', [App\Http\Controllers\CategoryController::class, 'storecategory'])->name('storecategory');

    Route::get('/admin/viewcategory', [App\Http\Controllers\CategoryController::class, 'viewcategory'])->name('viewcategory');
    Route::get('/admin/deletecategory/{id}', [App\Http\Controllers\CategoryController::class, 'deletecategory'])->name('deletecategory');

    Route::get('/admin/editcategory/{id}', [App\Http\Controllers\CategoryController::class, 'editcategory'])->name('editcategory');
    Route::post('/admin/updatecategory/{id}', [App\Http\Controllers\CategoryController::class, 'updatecategory'])->name('updatecategory');

    // routes for products

    Route::get('/admin/product', [App\Http\Controllers\ProductController::class, 'product'])->name('product');
    Route::post('/admin/product', [App\Http\Controllers\ProductController::class, 'storeproduct'])->name('storeproduct');
    Route::get('/admin/deleteproduct/{id}', [App\Http\Controllers\ProductController::class, 'deleteproduct'])->name('deleteproduct');

    Route::get('/admin/editproduct/{id}', [App\Http\Controllers\ProductController::class, 'editproduct'])->name('editproduct');
    Route::post('/admin/updateproduct/{id}', [App\Http\Controllers\ProductController::class, 'updateproduct'])->name('updateproduct');
    });


Route::middleware(['role:0'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/admin/filterproduct', [App\Http\Controllers\ProductController::class, 'filterproduct'])->name('filterproduct');

    Route::get('/user/cart', [App\Http\Controllers\CartController::class, 'cart'])->name('cart');
    Route::post('/user/add-to-cart', [App\Http\Controllers\CartController::class, 'addtocart'])->name('addtocart');


    Route::get('/user/removecart/{id}',[CartController::class,'removecart'])->name('removecart');
    Route::post('/user/checkout',[CartController::class,'checkout'])->name('checkout');

    Route::get('/user/orders',[OrderController::class,'orders'])->name('orders');
    
});