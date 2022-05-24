<?php

use App\Http\Controllers\ProductController;
use App\Models\Product;
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
    return view('index');
});
Route::resource('products',ProductController::class);
Route::get('fetch',[ProductController::class, 'fetchproduct']);
Route::get('edit-product/{id}',[ProductController::class, 'edit']);
Route::put('update-product/{id}',[ProductController::class, 'update']);
Route::delete('delete-product/{id}',[ProductController::class, 'destroy']);