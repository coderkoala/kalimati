<?php

use App\Http\Controllers\Frontend\PriceDiff;
use Tabuna\Breadcrumbs\Trail;

/*
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */

Route::get('comparative-prices', [PriceDiff::class, 'index'])
->name('comparative-prices')
->breadcrumbs(function (Trail $trail) {
    $trail->parent('frontend.index')
        ->push(__('Get Price History'), route('frontend.comparative-prices'));
});

Route::post('comparative-prices', [PriceDiff::class, 'post'])->name('price-diff-data');
