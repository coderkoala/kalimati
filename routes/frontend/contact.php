<?php

use App\Http\Controllers\Frontend\PagesController;
use Tabuna\Breadcrumbs\Trail;

/*
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */

Route::get('contact', [PagesController::class, 'contact'])
    ->name('pages.contact')
    ->breadcrumbs(function (Trail $trail) {
        $trail->parent('frontend.index')
            ->push(__('Contact us'), route('frontend.pages.contact'));
    });
