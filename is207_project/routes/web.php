<?php

use App\Http\Controllers\admin_controller;
use App\Http\Controllers\category_product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoriesController;



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

Route::get('/products', [ProductsController::class, 'index']);
Route::resource('products', ProductsController::class);
Route::resource('admin', AdminController::class);
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login');

Route::get('/',[HomeController::class,'index'])->name('home_page');
Route::get('/menu_page',[HomeController::class,'menu_page'])->name('menu_page');
Route::get('/order_page',[HomeController::class,'order_page'])->name('order_page');

Route::get('/categories',[CategoriesController::class,'index']);
