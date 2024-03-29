<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProgressController;
use App\Http\Controllers\Admin\UpdatableStatusOrderController;
use App\Http\Controllers\Admin\UpdatePaymentStatusController;
use App\Http\Controllers\Admin\UploadCashPaymentController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CreateInvoiceController;
use App\Http\Controllers\CreateReportController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GetAllCategoriesController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Product\SearchProductController;
use App\Http\Controllers\Product\ShowProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RescheduleController;
use App\Http\Controllers\UploadTransferPaymentController;
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

Route::get('/', LandingPageController::class);

// Search product.
Route::get('/products/search', SearchProductController::class)->name('products.search');

// Show product.
Route::get('/products/{product}', ShowProductController::class)->name('products.show');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // All about user.
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('address', AddressController::class)->except(['index', 'show']);

    // Store product into shopping cart.
    Route::post('/products/{product}/cart', [CartController::class, 'store'])->name('products.cart.store');

    // Show and delete shopping cart.
    Route::resource('cart', CartController::class)->only(['index', 'destroy']);

    // get all categories
    Route::get('/categories', GetAllCategoriesController::class)->name('categories.index');

    // get category and its products.
    Route::get('/categories/{category}/products', [CategoryController::class, 'show'])->name('categories.show');

    // Create invoice.
    Route::get('/order/{order}/invoice', [CreateInvoiceController::class, 'index'])->name('order.invoice');

    // Cancel order.
    Route::patch('/order/{order}/cancel', [OrderController::class, 'cancel'])->name('order.cancel');

    // CRUD for order.
    Route::resource('order', OrderController::class)->only(['index', 'create', 'store', 'show', 'destroy']);

    // Upload transfer payment proof.
    Route::resource('order.payments', UploadTransferPaymentController::class)->only(['create', 'store']);

    // Reschedule order.
    Route::resource('order.reschedule', RescheduleController::class)->only(['create', 'store', 'show']);

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
        Route::patch('/order/{order}/update-status', UpdatableStatusOrderController::class)->name('order.updateStatus');

        // Upload cash payment proof.
        Route::post('/order/{order}/payments/cash', [UploadCashPaymentController::class, 'store'])->name('order.payments.store');

        // update payment status.
        Route::patch('order/{order}/payments/{payment}/status', UpdatePaymentStatusController::class)->name('order.payments.updateStatus');

        // Store progress of an order.
        Route::post('/order/{order}/progress', [ProgressController::class, 'store'])->name('order.progress.store');

        // admin can approve reschedule order.
        Route::resource('order.reschedule', RescheduleController::class)->only(['update', 'destroy']);

        // Create report
        Route::get('order/reports/create', function () {
            return view('admin.report.create');
        })->name('order.reports.create');

        // Download the reports
        Route::post('/order/reports', CreateReportController::class)->name('order.reports.store');
    });
});

require __DIR__.'/auth.php';
