<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
Route::get('language/{language}', function ($language) {
    Session()->put('locale', $language);
 
    return redirect()->back();
})->name('language');

Route::get('/',[App\Http\Controllers\LandingPageController::class,'index'])->name('landingpage');
Route::get('/shop',[App\Http\Controllers\ShopController::class,'index'])->name('shop');
Route::resource('products', App\Http\Controllers\ProductController::class);
Route::resource('cart', App\Http\Controllers\CartController::class);
Route::delete('cart/deleteone/{product}',[ App\Http\Controllers\CartController::class,'deleteOne'])->name('cart.deleteOne');
Route::resource('categories', App\Http\Controllers\CategoryController::class);
Route::resource('checkout', App\Http\Controllers\CheckoutController::class);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');


Route::post('checkoutafterpayment',[App\Http\Controllers\CheckoutController::class,'afterpayment'])->name('checkout.credit-card');
Route::post('addcoupon',[App\Http\Controllers\CouponsController::class,'addCoupon'])->name('addcoupon');

Route::get('thankfororder',function(){
    return Inertia::render('Thank');
})->name('thank');
