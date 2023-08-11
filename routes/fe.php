<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\user\homeController;
use App\Http\Controllers\user\singlePageController;
use App\Http\Controllers\user\wishlistController;
use App\Http\Controllers\user\cartController;
use App\Http\Controllers\user\PayPalController;
use App\Http\Controllers\user\reviewController;

use Illuminate\Routing\Router;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/ 
    Route::prefix('/')->group(function(){
        Route::get('',[homeController::class,'home'])->name('home');
     
        Route::get('viewcart',[cartController::class,'viewCart'])->name('viewcart');
        Route::post('cart/{id}',[cartController::class,'addToCart'])->name('cart');
        Route::get('search',[homeController::class,'search'])->name('search');

        Route::get('pageoffer/{id}',[singlePageController::class,'pageOffer'])->name('pageoffer');
        Route::get('/detail/{id}',[singlePageController::class,'detail'])->name('detail');
        Route::get('shipper',[homeController::class,'shipper'])->middleware('auth')->name('shipper');
        Route::post('shipper/store',[homeController::class,'shipperStore'])->middleware('auth')->name('shipper.store');
        Route::post('shipperSuccess',[homeController::class,'shipperSuccess'])->middleware('auth')->name('shipperSuccess');
        Route::get('pageShip',[homeController::class,'pageShip'])->middleware('auth')->name('pageShip');
        Route::post('confirm',[homeController::class,'confirm'])->middleware('auth')->name('confirm');
        Route::get('/brand/{id}',[singlePageController::class,'brand'])->name('brand');
        Route::get('/category/{id}',[singlePageController::class,'category'])->name('categoty');
        
        Route::get('/filtering/{id}/{value}',[singlePageController::class,'filtering'])->name('filtering');
        Route::get('/filteringCategory/{id}/{value}',[singlePageController::class,'filteringCategory'])->name('filteringCategory');

        Route::middleware('auth')->prefix('/review')->group(function(){
            Route::post('/store/{id}',[reviewController::class,'store'])->name('review.store');
            Route::delete('/destroy/{id}',[reviewController::class,'destroy'])->name('review.destroy');
            Route::get('edit/{id}',[reviewController::class,'edit'])->name('review.edit');
            Route::post('update/{id}',[reviewController::class,'update'])->name('review.update');
        });
        Route::middleware('auth')->prefix('wishlist')->group(function(){
            Route::get('/{id}',[wishlistController::class,'index'])->name('wishlist');
            Route::post('store',[wishlistController::class,'store'])->name('wishlist.store');
            Route::delete('destroy/{id}',[wishlistController::class,'destroy'])->name('wishlist.destroy');
            Route::delete('delete/{id}',[wishlistController::class,'delete'])->name('wishlist.delete');
        });

        Route::get('history',[PayPalController::class, 'history'])->middleware('auth')->name('history');
        Route::post('payment', [payPalController::class, 'payment'])->middleware('auth')->name('payment');
        Route::post('process-transaction', [payPalController::class, 'processTransaction'])->middleware('auth')->name('processTransaction');
        Route::get('success-transaction', [payPalController::class, 'successTransaction'])->middleware('auth')->name('successTransaction');
        Route::get('cancel-transaction', [payPalController::class, 'cancelTransaction'])->middleware('auth')->name('cancelTransaction');
    })

?>