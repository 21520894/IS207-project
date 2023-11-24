<?php

use App\Http\Controllers\admin_controller;
use App\Http\Controllers\category_product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\UsersController;


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


// Route::resource('admin', AdminController::class);
// Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::get('/products', [ProductsController::class, 'index']) -> middleware(['auth:admin', 'verified'])->name('products');
Route::resource('products', ProductsController::class);
Route::get('/',[HomeController::class,'index'])->name('home_page');
Route::get('/menu_page',[HomeController::class,'menu_page'])->name('menu_page');
Route::get('/order_page',[HomeController::class,'order_page'])->name('order_page');

Route::get('/categories',[CategoriesController::class,'index']);

Route::get('/admin/register', [AdminController::class, 'create']);
//Route::resource('admin', AdminController::class);

// trang yêu cầu verify
// Route::get('/products', function () {
//     return view('/clients/products/index');
// }) -> middleware(['auth:admin', 'verified'])->name('products');

// Các trang yêu cầu verrifi để đăng nhập
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Route::middleware('auth:admin')->group(function () {
//     Route::get('/admin/dashboard', function () {
//         return view('admin.dashboard');
//     })->name('admin.dashboard');
//     Route::get('/products', function () {
//         return view('/products');
//     }) ->name('products');

// });

//Route::get('/admin', function () {
//    return view('admin.dashboard');
//})->middleware(['auth:admin', 'verified'])->name('admin.dashboard');

Route::middleware(['auth:admin', 'verified'])->prefix('admin')->group(function (){
    Route::get('', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    Route::prefix('dish')->group(function (){
        Route::get('', [ProductsController::class,'index'])->name('admin.dish.show');
        Route::get('edit', function (){
            return view('admin.dish.edit');
        });
    });

    Route::prefix('user')->group(function (){
        Route::get('', [UsersController::class,'index'])->name('admin.user.show');
        Route::get('edit',[UsersController::class,'edit'])->name('admin.user.edit');
    });
    Route::get('order', function (){
        return view('admin.ecommerce.order');
    })->name('admin.order.show');
    Route::get('voucher', function (){
        return view('admin.ecommerce.voucher');
    })->name('admin.voucher.show');
});

require __DIR__.'/adminauth.php';
