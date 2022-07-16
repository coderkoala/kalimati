<?php

use App\Http\Controllers\Frontend\HomeController;
use Tabuna\Breadcrumbs\Trail;

/*
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */

Route::get('arrival-history', [HomeController::class, 'checkArrivalHistory'])
->name('arrival-history')
->breadcrumbs(function (Trail $trail) {
    $trail->parent('frontend.index')
        ->push(__('Get Price History'), route('frontend.arrival-history'));
});


Route::post('arrival-history', [HomeController::class, 'checkArrivalPOST'])->name('arrivalHistoryPolling');
