<?php

use App\Http\Controllers\CreateInvoiceController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\Product\GetProductByCategoryNameController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;

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

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    # All about user.
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('address', AddressController::class)->except(['index', 'show']);

    # All about product.
    Route::resource('category', CategoryController::class)->only(['index', 'store', 'edit', 'update', 'destroy']);
    Route::resource('product', ProductController::class);
    Route::resource('cart', CartController::class)->only(['index', 'store', 'destroy']);
    Route::get('/getProductByCategoryName', GetProductByCategoryNameController::class)->name('getProductByCategoryName');

    # All about order.
    Route::get('/order/{order}/invoice', [CreateInvoiceController::class, 'index'])->name('order.invoice');
    Route::resource('order', OrderController::class)->only(['index', 'create', 'store', 'show', 'destroy']);
    Route::resource('order.payments', PaymentsController::class)->except('index');
});

require __DIR__ . '/auth.php';
