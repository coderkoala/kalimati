<?php

use App\Http\Controllers\Frontend\HomeController;
use Tabuna\Breadcrumbs\Trail;

/*
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */

Route::get('dues', [HomeController::class, 'checkPrices'])
    ->name('dues')
    ->breadcrumbs(function (Trail $trail) {
        $trail->parent('frontend.index')
            ->push(__('Trader Dues'), route('frontend.dues'));
    });


Route::post('dues', [HomeController::class, 'checkIndividualPrice'])->name('duesPolling');
