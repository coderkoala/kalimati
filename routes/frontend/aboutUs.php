<?php

use App\Http\Controllers\Frontend\PagesController;
use Tabuna\Breadcrumbs\Trail;

/*
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */

Route::get('about', [PagesController::class, 'aboutUs'])
    ->name('pages.about')
    ->breadcrumbs(function (Trail $trail) {
        $trail->parent('frontend.index')
            ->push(__('About Us'), route('frontend.pages.about'));
    });
