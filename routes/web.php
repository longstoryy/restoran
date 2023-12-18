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
Route::post('/send-email', [App\Http\Controllers\HomeController::class, 'sendEmail']);




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
    //deliverydetails
    Route::get('/delivery-details', [App\Http\Controllers\Users\UsersController::class, 'deliverDetails'])->name('delivery.details');

    //reviews
    Route::get('/write-review', [App\Http\Controllers\Users\UsersController::class, 'viewReview'])->name('users.review.create');
    Route::post('/write-review', [App\Http\Controllers\Users\UsersController::class, 'submitReview'])->name('users.review.store');


});

Route::get('admin/login', [App\Http\Controllers\Admins\AdminsController::class, 'viewLogin'])->name('view.login')->middleware('checkforauth');
Route::post('admin/login', [App\Http\Controllers\Admins\AdminsController::class, 'checkLogin'])->name('check.login');



Route::group(["prefix"=> "admin","middleware"=>"auth:admin"],function(){
    Route::get('index', [App\Http\Controllers\Admins\AdminsController::class, 'index'])->name('admins.dashboard');

    //admin

    Route::get('all-admins', [App\Http\Controllers\Admins\AdminsController::class, 'allAdmins'])->name('admins.all');
    Route::get('admins', [App\Http\Controllers\Admins\AdminsController::class, 'createAdmins'])->name('admins.create');
    Route::post('admins', [App\Http\Controllers\Admins\AdminsController::class, 'storeAdmins'])->name('admins.store');

    //orders
    Route::get('all-orders', [App\Http\Controllers\Admins\AdminsController::class, 'allOrders'])->name('orders.all');
    Route::get('edit-orders/{id}', [App\Http\Controllers\Admins\AdminsController::class, 'editOrders'])->name('orders.edit');
    Route::post('edit-orders/{id}', [App\Http\Controllers\Admins\AdminsController::class, 'updateOrders'])->name('orders.update');
    Route::get('delete-orders/{id}', [App\Http\Controllers\Admins\AdminsController::class, 'deleteOrders'])->name('orders.delete');

    //bookings
    Route::get('all-bookings', [App\Http\Controllers\Admins\AdminsController::class, 'allBookings'])->name('bookings.all');
    Route::get('edit-bookings/{id}', [App\Http\Controllers\Admins\AdminsController::class, 'editBookings'])->name('bookings.edit');
    Route::post('edit-bookings/{id}', [App\Http\Controllers\Admins\AdminsController::class, 'updateBookings'])->name('bookings.update');
    Route::get('delete-bookings/{id}', [App\Http\Controllers\Admins\AdminsController::class, 'deleteBookings'])->name('bookings.delete');
    


    //food items
    Route::get('all-foods}', [App\Http\Controllers\Admins\AdminsController::class, 'allFoods'])->name('all.foods');
    Route::get('create-food}', [App\Http\Controllers\Admins\AdminsController::class, 'createFood'])->name('create.foods');
    Route::post('create-food}', [App\Http\Controllers\Admins\AdminsController::class, 'storeFood'])->name('store.foods');
    Route::get('delete-food/{id}', [App\Http\Controllers\Admins\AdminsController::class, 'deleteFood'])->name('delete.foods');
    
    //delivery
    Route::get('all-delivery-details', [App\Http\Controllers\Admins\AdminsController::class, 'allDelivery'])->name('delivery.all');
    Route::get('create-register}', [App\Http\Controllers\Admins\AdminsController::class, 'registerDelivery'])->name('register.delivery');
    Route::post('create-register}', [App\Http\Controllers\Admins\AdminsController::class, 'deliveryDetails'])->name('store.delivery');
    Route::get('delete-delivery/{id}', [App\Http\Controllers\Admins\AdminsController::class, 'deleteDelivery'])->name('delete.delivery');
    Route::get('edit-delivery/{id}', [App\Http\Controllers\Admins\AdminsController::class, 'editDelivery'])->name('delivery.edit');
    Route::post('edit-delivery/{id}', [App\Http\Controllers\Admins\AdminsController::class, 'updateDelivery'])->name('delivery.update');

    //delive
    //search
    Route::get('/search', [App\Http\Controllers\Admins\AdminsController::class, 'search']);
    Route::get('selectorders/{id}', [App\Http\Controllers\Admins\AdminsController::class, 'selectDelivery'])->name('select.delivery');

});