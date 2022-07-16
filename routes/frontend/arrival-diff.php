<?php

use App\Http\Controllers\Frontend\ArrivalDiff;
use Tabuna\Breadcrumbs\Trail;

/*
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */

Route::get('arrival-comparision', [ArrivalDiff::class, 'index'])
->name('arrival-comparision')
->breadcrumbs(function (Trail $trail) {
    $trail->parent('frontend.index')
        ->push(__('Get Price History'), route('frontend.arrival-comparision'));
});

Route::post('arrival-comparision', [ArrivalDiff::class, 'post'])->name('arrival-diff-data');
