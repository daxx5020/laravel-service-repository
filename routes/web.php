<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin/home', [App\Http\Controllers\HomeController::class, 'admin'])->name('admin.home');

Route::get('/admin/category', [App\Http\Controllers\HomeController::class, 'category'])->name('category');
Route::post('/admin/category', [App\Http\Controllers\HomeController::class, 'storecategory'])->name('storecategory');

Route::get('/admin/viewcategory', [App\Http\Controllers\HomeController::class, 'viewcategory'])->name('viewcategory');
Route::get('/admin/deletecategory/{id}', [App\Http\Controllers\HomeController::class, 'deletecategory'])->name('deletecategory');

Route::get('/admin/editcategory/{id}', [App\Http\Controllers\HomeController::class, 'editcategory'])->name('editcategory');
Route::post('/admin/updatecategory/{id}', [App\Http\Controllers\HomeController::class, 'updatecategory'])->name('updatecategory');


// routes for products

Route::get('/admin/product', [App\Http\Controllers\HomeController::class, 'product'])->name('product');
Route::post('/admin/product', [App\Http\Controllers\HomeController::class, 'storeproduct'])->name('storeproduct');

// Route::get('/admin/viewproduct', [App\Http\Controllers\HomeController::class, 'viewproduct'])->name('viewproduct');
Route::get('/admin/deleteproduct/{id}', [App\Http\Controllers\HomeController::class, 'deleteproduct'])->name('deleteproduct');

Route::get('/admin/editproduct/{id}', [App\Http\Controllers\HomeController::class, 'editproduct'])->name('editproduct');
Route::post('/admin/updateproduct/{id}', [App\Http\Controllers\HomeController::class, 'updateproduct'])->name('updateproduct');

Route::get('/admin/filterproduct', [App\Http\Controllers\HomeController::class, 'filterproduct'])->name('filterproduct');


// Routes for users

Route::get('/user/cart', [App\Http\Controllers\HomeController::class, 'cart'])->name('cart');
Route::post('/user/add-to-cart', [App\Http\Controllers\HomeController::class, 'addtocart'])->name('addtocart');


Route::get('/user/removecart/{id}',[HomeController::class,'removecart'])->name('removecart');
Route::post('/user/checkout',[HomeController::class,'checkout'])->name('checkout');

Route::get('/user/orders',[HomeController::class,'orders'])->name('orders');