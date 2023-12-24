<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

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


