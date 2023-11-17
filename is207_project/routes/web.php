<?php

use App\Http\Controllers\admin_controller;
use App\Http\Controllers\category_product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;

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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/test', function () {
//     echo 'test';
// });
// Route::get('/admin', [admin_controller::class,'index']);
// Route::get('/admin_page', [admin_controller::class,'show_dashboard']);
// Route::get('/admin_logout', [admin_controller::class,'logout']);
// Route::post('/admin_login', [admin_controller::class,'login_check']);

// //category
// Route::post('/add_product',[category_product::class,'add_product']);    // add more food
// Route::get('/list_product', [category_product::class,'list_product']); //view the food list

Route::get('/', [ProductController::class, 'index']);
Route::resource('products', ProductController::class);
Route::resource('admin', AdminController::class);
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login');



