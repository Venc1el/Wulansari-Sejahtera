<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\http\Controllers\DashboardController;
use App\http\Controllers\OrderController;
use App\http\Controllers\ItemController;
use App\http\Controllers\CartController;
use Illuminate\Support\Facades\Gate;

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

Route::get('/', [ItemController::class, 'index'])->name('welcome');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified', 'can:access-dashboard'])
    ->name('dashboard');


Route::middleware('auth', 'can:access-dashboard')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function(){
    Route::post('/cart/add/{itemId}', [CartController::class, 'addItem'])->name('cart.add');
    Route::post('/cart/update/{itemId}', [CartController::class, 'updateQuantity'])->name('cart.update');
    Route::post('/cart/remove/{itemId}', [CartController::class, 'removeItem'])->name('cart.remove');
    Route::get('/cart/subtotal', [CartController::class, 'subtotal']);
    Route::post('place-order', [OrderController::class, 'placeOrder'])->name('place.order');
    Route::get('/cart/empty', [CartController::class, 'emptyCart'])->name('cart.empty');
});


require __DIR__ . '/auth.php';
