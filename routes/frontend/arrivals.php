<?php

use App\Http\Controllers\Frontend\HomeController;
use Tabuna\Breadcrumbs\Trail;

/*
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */

Route::get('daily-arrivals', [HomeController::class, 'checkArrivals'])
->name('daily-arrivals')
->breadcrumbs(function (Trail $trail) {
    $trail->parent('frontend.index')
        ->push(__('Get Arrivals'), route('frontend.daily-arrivals'));
});


Route::post('daily-arrivals', [HomeController::class, 'checkArrivalsPOST'])->name('daily-arrivals-POST');
