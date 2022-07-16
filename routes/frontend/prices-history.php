<?php

use App\Http\Controllers\Frontend\HomeController;
use Tabuna\Breadcrumbs\Trail;

/*
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */

Route::get('price-history', [HomeController::class, 'checkPriceHistory'])
->name('price-history')
->breadcrumbs(function (Trail $trail) {
    $trail->parent('frontend.index')
        ->push(__('Get Price History'), route('frontend.price-history'));
});


Route::post('price', [HomeController::class, 'checkDailyPricesPOST'])->name('pricePolling');
