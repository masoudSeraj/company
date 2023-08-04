<?php

use Illuminate\Support\Facades\Route;
use Sunnyr\Company\Http\Controllers\MainController;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Sunnyr\Company\Http\Controllers\ContactusController;
use Sunnyr\Company\Http\Controllers\Products\ProductController;
use Sunnyr\Company\Http\Controllers\Products\ProductFilterController;

Route::group(['middleware' => ['web']], function(){
    Route::get('/', [MainController::class, 'index'])->name('company.index');
    Route::group(['as' => 'product.', 'prefix' => 'product'], function(){
        Route::get('random', [ProductController::class, 'random'])->name('random');
    });

    Route::group(['as' => 'filters.', 'prefix' => 'filters'], function(){
        Route::get('/products', [ProductFilterController::class, 'filter'])->name('products');
        Route::get('/product/{id}', [ProductController::class, 'show'])->middleware(SubstituteBindings::class)->name('product.show');
    });

    Route::group(['as' => 'contact-us.', 'prefix' => 'company'], function(){
        Route::get('/contact-us', [ContactusController::class, 'index'])->name('index');
        Route::post('/contact-us/store', [ContactusController::class, 'store'])->name('store');
    });

    Route::group(['as' => 'fortify.auth.', 'prefix' => '/company'], function(){
        require __DIR__.'/fortify.php';
    });
});
