<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UpdatableStatusOrderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CreateInvoiceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\Product\GetProductByCategoryNameController;
use App\Http\Controllers\Product\SearchProductController;
use App\Http\Controllers\Product\ShowProductController;
use App\Http\Controllers\ProfileController;
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

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // All about user.
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('address', AddressController::class)->except(['index', 'show']);

    // Search product.
    Route::get('/products/search', SearchProductController::class)->name('products.search');

    // Show product.
    Route::get('/products/{product}', ShowProductController::class)->name('products.show');

    // Store product into shopping cart.
    Route::post('/products/{product}/cart', [CartController::class, 'store'])->name('products.cart.store');

    // Show and delete shopping cart.
    Route::resource('cart', CartController::class)->only(['index', 'destroy']);

    // Get product by category name.
    Route::get('/getProductByCategoryName', GetProductByCategoryNameController::class)->name('getProductByCategoryName');

    // Create invoice.
    Route::get('/order/{order}/invoice', [CreateInvoiceController::class, 'index'])->name('order.invoice');

    // Cancel order.
    Route::patch('/order/{order}/cancel', [OrderController::class, 'cancel'])->name('order.cancel');

    // CRUD for order.
    Route::resource('order', OrderController::class)->only(['index', 'create', 'store', 'show', 'destroy']);
    Route::resource('order.payments', PaymentsController::class)->except('index');

    // Admin
    Route::group([
        'prefix' => 'admin',
        'as' => 'admin.',
        'middleware' => 'admin',
    ], function () {
        // List all users.
        Route::get('/users', UserController::class)->name('users');

        // CRUD for categories.
        Route::resource('/categories', CategoryController::class)->except(['create', 'show']);

        // CRUD for products.
        Route::resource('/products', ProductController::class)->except('show');

        // Update order status.
        Route::patch('/order/{order}', UpdatableStatusOrderController::class)->name('order.updateStatus');
    });
});

require __DIR__ . '/auth.php';
