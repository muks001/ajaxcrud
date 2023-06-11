<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SchoolController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('product', ProductController::class);

Route::get('edit-product',[ProductController::class,'editProduct'])->name('edit.product');

Route::post('update-product',[ProductController::class,'updateProduct'])->name('update.product');

Route::resource('post',PostController::class);


Route::resource('category', CategoryController::class);

Route::resource('school', SchoolController::class);