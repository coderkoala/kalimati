<?php

use Tabuna\Breadcrumbs\Trail;
use App\Http\Controllers\Backend\CRM\AccountController;

Route::get('account', [AccountController::class, 'index'])
    ->name('account')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'));
        $trail->push(__('CRM'));
        $trail->push(__('Account Management'), route('admin.account'));
    });
