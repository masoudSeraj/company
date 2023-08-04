<?php

use Sunnyr\Company\Http\Controllers\Brands\BrandController;
use Sunnyr\Company\Http\Controllers\Categories\CategoryController;
use Sunnyr\Company\Http\Controllers\Users\UserActivationController;

Route::group(['prefix' => '/api', 'as' => 'api.'], function(){
    Route::get('/categories/{ids}', [CategoryController::class, 'details'])->name('categories.details');
    Route::get('/brands/{ids}', [BrandController::class, 'details'])->name('brands.details');
    Route::get('/register/{userId}/activation/code', [UserActivationController::class, 'generateCode'])->name('acivation.code');
});
?>