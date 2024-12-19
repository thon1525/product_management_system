<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ManageUserController;
use App\Http\Controllers\Product;
use App\Http\Controllers\ConstomerController;

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\ProductModel;

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
    $products = ProductModel::all();
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),

        'ProductModel' => $products,
    ]);
});

// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'role:admin'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'role:admin'])->name('dashboard');

// Adding additional routes within a middleware group
Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/ooo', function () {
        return 'thon';
    });
    Route::get('/index', [DashboardController::class, 'index'])->name('home.dashboard');
    Route::get('/user/management', [ManageUserController::class, 'index'])->name('user.dashboard.management');
    Route::get('/user/management/create', [ManageUserController::class, 'create'])->name('user.dashboard.management.create');
    Route::get('/user/management/create/edit/{id}', [ManageUserController::class, 'create_edit'])->name('user.dashboard.management.create.edit');
    Route::patch('/user/management/update/{id}', [ManageUserController::class, 'update'])->name('user.dashboard.management.update');
    Route::post('/user/management/store', [ManageUserController::class, 'store'])->name('user.dashboard.management.store');
    Route::delete('/user/management/delete/{id}', [ManageUserController::class, 'destroy'])->name('user.dashboard.management.delete');


    // create product
    Route::get('/product/create', [Product::class, 'create'])->name('create.product');
    Route::get('/product/index', [Product::class, 'index'])->name('create.management');
    Route::delete('/product/delete/{id}', [Product::class, 'destroy'])->name('product.destroy');
    Route::post('/product/create/store', [Product::class, 'store'])->name('create.product.store');

});


Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::get('/constomer/account/index', [ConstomerController::class, 'create'])->name('constomer.account');
    Route::get('/constomer/account/index/history/{id}', [ConstomerController::class, 'create_history'])->name('constomer.account.history.create');
    Route::get('/customer/account/history/order', [ConstomerController::class, 'orderHistory'])->name('customer.account.orders.history');
    Route::post('/constomer/account/checkout', [ConstomerController::class, 'store'])->name('constomer.account.checkout');
    Route::get('/constmer', function () {
        return  'sdfsdfrwweewr';
    });
});

Route::middleware('guest')->group(function () {
    Route::get('/guest', function () {
        return  'sdfsdfrwweewr';
    });
     // reading product
     Route::get('/product/list/card', [Product::class, 'create_card_product'])->name('create.product.list.card');
});
require __DIR__.'/auth.php';
