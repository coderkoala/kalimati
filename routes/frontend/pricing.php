<?php

use App\Http\Controllers\Frontend\HomeController;
use Tabuna\Breadcrumbs\Trail;

/*
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */

Route::get('price', [HomeController::class, 'checkDailyPrices'])
->name('price')
->breadcrumbs(function (Trail $trail) {
    $trail->parent('frontend.index')
        ->push(__('Get Prices'), route('frontend.price'));
});

Route::post('price', [HomeController::class, 'checkDailyPricesPOST'])->name('pricePolling');
