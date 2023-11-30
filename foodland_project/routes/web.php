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
Route::middleware(['isAdmin'])->prefix('admin')->group(function (){
    Route::get('',function (){
        return view('admin.dashboard');
    } )->name('admin.dashboard');
    Route::prefix('dish')->group(function (){
        Route::get('', [ProductsController::class,'index'])->name('admin.dish.show');
        Route::post('',[ProductsController::class,'store'])->name('admin.dish.add');

        Route::get('edit', [ProductsController::class,'edit'])->name('admin.dish.edit');
        Route::post('edit', [ProductsController::class,'update'])->name('admin.dish.update');
        Route::delete('',[ProductsController::class,'destroy'])->name('admin.dish.delete');
    });

    Route::prefix('user')->group(function (){
        Route::get('', [UsersController::class,'index'])->name('admin.user.show');
        Route::get('edit',[UsersController::class,'edit'])->name('admin.user.edit');
        Route::post('edit',[UsersController::class,'update'])->name('admin.user.update');
        Route::delete('',[UsersController::class,'destroy'])->name('admin.user.delete');
    });
    Route::get('order', [OrdersController::class,'index'])->name('admin.order.show');
    Route::get('voucher', function (){
        return view('admin.ecommerce.voucher');
    })->name('admin.voucher.show');
});



//Customer
Route::get('/',[HomeController::class,'index'])->name('home_page');
Route::get('/menu_page',[HomeController::class,'menu'])->name('menu_page');
Route::get('/order_page',[HomeController::class,'order'])->name('order_page');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
