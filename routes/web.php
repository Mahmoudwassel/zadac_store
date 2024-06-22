<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SocialiteController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;

Route::get('/',[ProductController::class , 'index'])->name('home');
Route::get('/home', [HomeController::class ,'index'])->Middleware(['auth', 'verified'])->name('dashboard');
// Route::get('/ZADAC/admin',[ProductController::class , 'index2'])->name('admin.page');
Route::get('/your.cart/{id}',[CartController::class,'store'])->name('addtocard');
Route::get('/your.cart',[CartController::class,'show'])->name('show card');
Route::get('delet/from/cart/{item}',[CartController::class,'delete'])->name('delet.card');

Route::middleware('auth')->group(function()
{
    route::get('/add/product',[ProductController::class , 'create'])->name('add-product');
    route::Post('/store/product',[ProductController::class , 'store'])->name('store.product');
    Route::get('/edit/product/{id}',[ProductController::class,'edit'])->name('edit.product');
    Route::get('/update/product/{id}',[ProductController::class,'update'])->name('update.product');
    Route::get('/delete/product/{id}',[ProductController::class,'delete'])->name('destroy.product');
    Route::delete('delet/from/cart',[CartController::class,'delet'])->name('remove_from_cart');


    
    Route::get('/payment/{drive}',[PaymentController::class ,'index'])->where('driver' , 'stripe'); // ->name('payment.page');
    Route::get('/success',[PaymentController::class,'success'])->name('success');
    Route::get('/cancel',[PaymentController::class,'cancel'])->name('cancel');

});

Route::get('/show/message',[MessageController::class,'index'])->name('show.message');
route::post('/store/message',[MessageController::class,'store'])->name('store.message');
route::get('/delete/message/{id}',[MessageController::class , 'destroy'])->name('delete.message');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::prefix('github')->name('zadac.')->controller(SocialiteController::class)->group(function(){
//     Route::get('/login','login')->name('login');
//     Route::get('/redirect','redirect')->name('redirect');
// });
Route::get('/socialite/{driver}',[SocialiteController::class , 'toprovider'])->where('driver','github|google|facebook');
Route::get('/auth/{driver}/login',[SocialiteController::class , 'handelCallback']); // callback url that the websit return to it 

require __DIR__.'/auth.php';
