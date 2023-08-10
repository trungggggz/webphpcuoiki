<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\user\homeController;
use App\Http\Controllers\user\singlePageController;
use App\Http\Controllers\user\wishlistController;
use App\Http\Controllers\user\cartController;

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

        Route::get('pageoffer/{id}',[singlePageController::class,'pageOffer'])->name('pageoffer');
        Route::middleware('auth')->prefix('wishlist')->group(function(){
            Route::get('/{id}',[wishlistController::class,'index'])->name('wishlist');
            Route::post('store',[wishlistController::class,'store'])->name('wishlist.store');
            Route::delete('destroy/{id}',[wishlistController::class,'destroy'])->name('wishlist.destroy');
            Route::delete('delete/{id}',[wishlistController::class,'delete'])->name('wishlist.delete');
        });
    })

?>