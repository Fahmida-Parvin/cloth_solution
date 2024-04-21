<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\LaundryController;


Route::get('/success', [PagesController::class, 'success'])->name('success');

Route::get('/', [PagesController::class, 'home'])->name('home');
Route::get('/cart', [PagesController::class, 'cart'])->name('cart');
Route::get('/wishlist', [PagesController::class, 'wishList'])->name('wishlist');
Route::get('/account', [PagesController::class, 'account'])->name('account')->middleware('auth');
Route::get('/checkout', [PagesController::class, 'checkout'])->name('checkout')->middleware('auth');

// Route::post('/stripe-checkout', [CheckoutController::class, 'stripeCheckout'])->name('stripeCheckout')->middleware('auth');

Route::post('/test-stripe-checkout', [CheckoutController::class, 'stripeCheckout'])->name('testStripeCheckout')->middleware('auth');

Route::get('/product/{id}', [PagesController::class, 'product'])->name('product');
Route::get('/laundry', [PagesController::class, 'laundry'])->name('laundry');

Route::get('/pickup', [LaundryController::class, 'showPickupForm'])->name('pickup');
Route::post('/pickup', [LaundryController::class, 'storePickup'])->name('pickup.store');



//cart
Route::post('/add-to-cart/{id}', [CartController::class, 'addToCart'])->name('addToCart');
Route::post('/remove-from-cart/{id}', [CartController::class, 'removeFromCart'])->name('removeFromCart');

//wishlist

Route::post('/add-to-wishlist/{id}',[WishlistController::class,'post'])->name('addToWishlist')->middleware('auth');
Route::post('/remove-from-wishlist/{id}',[WishlistController::class,'remove'])->name('removeFromWishlist')->middleware('auth');

//auth

Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register')->middleware('guest');

//

Route::post('/register', [AuthController::class, 'postRegister'])->name('register')->middleware('guest');
Route::post('/login', [AuthController::class, 'postLogin'])->name('login')->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

//adminpanel

Route::group(['prefix' => 'adminpanel', 'middleware' => 'admin'], function () {

    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/viewOrder/{id}', [AdminController::class, 'viewOrder'])->name('admin.viewOrder');
    Route::put('/adminpanel/updateOrderStatus/{id}', [AdminController::class, 'updateOrderStatus'])->name('admin.updateOrderStatus');


    //products
    Route::group(['prefix' => 'products'], function () {
        Route::get('/', [ProductController::class, 'index'])->name('adminpanel.products');
        Route::get('/create', [ProductController::class, 'create'])->name('adminpanel.products.create');
        Route::post('/create', [ProductController::class, 'store'])->name('adminpanel.products.store');
        Route::get('/{id}', [ProductController::class, 'edit'])->name('adminpanel.products.edit');
        Route::put('/{id}', [ProductController::class, 'update'])->name('adminpanel.products.edit');
        Route::delete('/{id}', [ProductController::class, 'destroy'])->name('adminpanel.products.destroy');

    });

    Route::group(['prefix' => 'categories'], function () {
        Route::get('/', [CategoryController::class, 'index'])->name('adminpanel.categories');
        Route::post('/create', [CategoryController::class, 'store'])->name('adminpanel.categories.store');
        Route::delete('/{id}', [CategoryController::class, 'destroy'])->name('adminpanel.categories.destroy');

    });

    Route::group(['prefix' => 'colors'], function () {
        Route::get('/', [ColorController::class, 'index'])->name('adminpanel.colors');
        Route::post('/create', [ColorController::class, 'store'])->name('adminpanel.color.store');
        Route::delete('/{id}', [ColorController::class, 'destroy'])->name('adminpanel.color.destroy');

    });

    Route::group(['prefix' => 'orders'], function () {
    Route::get('/', [OrderController::class, 'index'])->name('adminpanel.orders');
    Route::get('/{id}', [OrderController::class, 'view'])->name('adminpanel.orders.view');
    Route::post('/{id}', [OrderController::class, 'updateStatus'])->name('adminpanel.order.status.update');
});



    

});

