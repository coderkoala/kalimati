<?php

use App\Http\Controllers\Frontend\NoticeController;
use Tabuna\Breadcrumbs\Trail;

/*
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */

Route::get('notice', [NoticeController::class, 'index'])
    ->name('pages.noticeIndex')
    ->breadcrumbs(function (Trail $trail) {
        $trail->parent('frontend.index')
            ->push(__('Notices'), route('frontend.pages.noticeIndex'));
    });

Route::get('notices/{prefix}', [NoticeController::class, 'index'])
    ->name('pages.notice')
    ->breadcrumbs(function (Trail $trail) {
        $trail->parent('frontend.index')
            ->push(__('Notices'), route('frontend.pages.notice'));
    });

Route::get('notice/{id}', [NoticeController::class, 'show'])
    ->name('pages.notice-show')
    ->breadcrumbs(function (Trail $trail) {
        $trail->parent('frontend.index')
            ->push(__('View Notice'), route('frontend.pages.notice-show'));
    });
