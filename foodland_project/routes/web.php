<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\OrdersController;

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
//admin
Route::middleware(['isAdmin'])->prefix('admin')->group(function () {
    Route::get('', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    Route::prefix('dish')->group(function () {
        Route::get('', [ProductsController::class, 'index'])->name('admin.dish.show');
        Route::post('', [ProductsController::class, 'store'])->name('admin.dish.add');

        Route::get('edit', [ProductsController::class, 'edit'])->name('admin.dish.edit');
        Route::post('edit', [ProductsController::class, 'update'])->name('admin.dish.update');
        Route::delete('', [ProductsController::class, 'destroy'])->name('admin.dish.delete');

        Route::get('/pagination/paginate-data', [ProductsController::class, 'pagination']);
        Route::get('/show-product-via-category', [ProductsController::class, 'showDishByGroup'])->name('admin.dish.show.category');
        Route::get('/show-menu-via-category', [ProductsController::class, 'showMenuByGroup'])->name('clients.dish.show.category');
        Route::get('/search-product', [ProductsController::class, 'search'])->name('admin.dish.search');
    });

    Route::prefix('user')->group(function () {
        Route::get('', [UsersController::class, 'index'])->name('admin.user.show');
        Route::get('edit', [UsersController::class, 'edit'])->name('admin.user.edit');
        Route::post('edit', [UsersController::class, 'update'])->name('admin.user.update');
        Route::delete('', [UsersController::class, 'destroy'])->name('admin.user.delete');
        Route::get('/pagination/paginate-data', [UsersController::class, 'pagination']);
        Route::get('/show-user-by-group', [UsersController::class, 'showUserByGroup'])->name('admin.user.showByGroup');

        Route::get('/search-user', [UsersController::class, 'search'])->name('admin.user.search');

    });
    Route::prefix('order')->group(function () {
        Route::get('', [OrdersController::class, 'index'])->name('admin.order.show');
        Route::get('/show-order-by-status', [OrdersController::class, 'showOrderByStatus'])->name('admin.order.showByStatus');
        Route::get('/search-oder', [OrdersController::class, 'search'])->name('admin.order.search');
        Route::get('/search-oder-by-date', [OrdersController::class, 'searchByDate'])->name('admin.order.searchByDate');

    });

    Route::get('voucher', function () {
        return view('admin.ecommerce.voucher');
    })->name('admin.voucher.show');
});


//Customer
Route::get('/', [HomeController::class, 'index'])->name('home_page');
Route::get('/menu_page', [HomeController::class, 'menu'])->name('menu_page');
Route::get('/order_page', [HomeController::class, 'order'])->name('order_page');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
