<?php

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\TermsController;
use Tabuna\Breadcrumbs\Trail;

/*
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */
Route::get('/', [HomeController::class, 'index'])
    ->name('index')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('frontend.index'));
    });

Route::get('terms', [TermsController::class, 'index'])
    ->name('pages.terms')
    ->breadcrumbs(function (Trail $trail) {
        $trail->parent('frontend.index')
            ->push(__('Terms & Conditions'), route('frontend.pages.terms'));
    });

Route::get('dues', [HomeController::class, 'checkPrices'])
    ->name('dues')
    ->breadcrumbs(function (Trail $trail) {
        $trail->parent('frontend.index')
            ->push(__('Trader Dues'), route('frontend.dues'));
    });

    
Route::post('dues', [HomeController::class, 'checkIndividualPrice'])->name('duesPolling');

    
Route::get('price', [HomeController::class, 'checkDailyPrices'])
->name('price')
->breadcrumbs(function (Trail $trail) {
    $trail->parent('frontend.index')
        ->push(__('Get Prices'), route('frontend.price'));
});


Route::post('price', [HomeController::class, 'checkDailyPricesPOST'])->name('pricePolling');
