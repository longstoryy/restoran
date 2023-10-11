<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/about', [App\Http\Controllers\HomeController::class, 'about'])->name('about');
Route::get('/services', [App\Http\Controllers\HomeController::class, 'services'])->name('services');
Route::get('/contact', [App\Http\Controllers\HomeController::class, 'contact'])->name('contact');



Route::group(["prefix"=> "foods"],function(){
    Route::get('/food-details/{id}', [App\Http\Controllers\Foods\FoodsController::class, 'foodDetails'])->name('food.details');

    //cart
    Route::post('/food-details/{id}', [App\Http\Controllers\Foods\FoodsController::class, 'cart'])->name('food.cart');
    Route::get('/cart', [App\Http\Controllers\Foods\FoodsController::class, 'displayCartItems'])->name('food.display.cart');
    Route::get('/delete-cart/{id}', [App\Http\Controllers\Foods\FoodsController::class, 'deleteCartItems'])->name('food.delete.cart');
    
    //checkout
    Route::post('/prepare-checkout', [App\Http\Controllers\Foods\FoodsController::class, 'prepareCheckout'])->name('prepare.checkout');
    //insert user info
    Route::get('/checkout', [App\Http\Controllers\Foods\FoodsController::class, 'checkout'])->name('foods.checkout');

    Route::post('/checkout', [App\Http\Controllers\Foods\FoodsController::class, 'storeCheckout'])->name('foods.checkout.store');
    //pay with paypal
    Route::get('/pay', [App\Http\Controllers\Foods\FoodsController::class, 'payWithPaypal'])->name('foods.pay');

    Route::get('/success', [App\Http\Controllers\Foods\FoodsController::class, 'success'])->name('foods.success');

    //booking tables
    Route::post('/booking', [App\Http\Controllers\Foods\FoodsController::class, 'bookingTables'])->name('foods.booking.table');

    //menu
    Route::get('/menu', [App\Http\Controllers\Foods\FoodsController::class, 'menu'])->name('foods.menu');

});


Route::group(["prefix"=> "user"],function(){
    //users
    Route::get('/all-bookings', [App\Http\Controllers\Users\UsersController::class, 'getBookings'])->name('users.bookings');
    Route::get('/all-orders', [App\Http\Controllers\Users\UsersController::class, 'getOrders'])->name('users.orders');

    //reviews
    Route::get('/write-review', [App\Http\Controllers\Users\UsersController::class, 'viewReview'])->name('users.review.create');
    Route::post('/write-review', [App\Http\Controllers\Users\UsersController::class, 'submitReview'])->name('users.review.store');


});



