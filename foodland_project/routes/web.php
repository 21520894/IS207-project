<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\ChartController;
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
        $orderController = new OrdersController();
        $temp = $orderController -> getRevenueByMonths();
        $userController = new UsersController();
        $userCount = $userController -> getCountUser();
        return view('admin.dashboard',compact('temp','userCount'));
    })->name('admin.dashboard');
    Route::get('revenue', [OrdersController::class, 'getRevenue']) -> name('admin.revenue');
    Route::prefix('dish')->group(function () {
        Route::get('', [ProductsController::class, 'index'])->name('admin.dish.show');
        Route::post('', [ProductsController::class, 'store'])->name('admin.dish.add');

        Route::get('edit', [ProductsController::class, 'edit'])->name('admin.dish.edit');
        Route::post('edit', [ProductsController::class, 'update'])->name('admin.dish.update');
        Route::delete('', [ProductsController::class, 'destroy'])->name('admin.dish.delete');

        Route::get('/pagination/paginate-data', [ProductsController::class, 'pagination']);
        Route::get('/show-product-via-category', [ProductsController::class, 'showDishByGroup'])->name('admin.dish.show.category');
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
        Route::delete('', [OrdersController::class, 'destroy'])->name('admin.order.delete');
        Route::get('/pagination/paginate-data', [OrdersController::class, 'pagination']);
        Route::get('/show-order-detail',[OrdersController::class,'orderDetail'])->name('admin.order.detail');
    });

    Route::prefix('promotion')->group(function (){
        Route::get('/',[PromotionController::class,'index'])->name('admin.promotion.show');
        Route::post('',[PromotionController::class,'store'])->name('admin.promotion.add');
        Route::get('/pagination/paginate-data', [PromotionController::class, 'pagination']);
        Route::delete('', [PromotionController::class, 'destroy'])->name('admin.promotion.delete');
        Route::get('/search-promotion', [PromotionController::class, 'search'])->name('admin.promotion.search');
    });
});


//Customer
Route::get('/', [HomeController::class, 'index'])->name('home_page');
Route::get('/menu_page', [HomeController::class, 'menu'])->name('menu_page');
Route::get('/order_page', [HomeController::class, 'order'])->name('order_page');
Route::get('/show-menu-via-category', [ProductsController::class, 'showMenuByGroup'])->name('clients.dish.show.category');
Route::get('/search-dish', [ProductsController::class, 'searchForClients'])->name('clients.dish.search');
Route::middleware(['auth'])->group(function (){
    Route::post('/vnpay-payment',[CheckoutController::class,'vnpayPayment'])->name('vnpay.payment');
    Route::get('/vnpay-return',[CheckoutController::class,'vnpayReturn'])->name('vnpay.return');
    Route::get('/order-progress',[CheckoutController::class,'orderProgress'])->name('order.progress');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


