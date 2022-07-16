<?php

use App\Http\Controllers\Frontend\PageController;
use Tabuna\Breadcrumbs\Trail;

/*
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */
Route::get('/pages/{page}', [PageController::class, 'index'])
    ->name('pages')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('frontend.pages'));
    });
