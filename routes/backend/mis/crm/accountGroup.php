<?php

use Tabuna\Breadcrumbs\Trail;
use App\Http\Controllers\Backend\CRM\AccountGroupController;

Route::get('account-group', [AccountGroupController::class, 'index'])
    ->name('account-group')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'));
        $trail->push(__('CRM'));
        $trail->push(__('Account Groups Management'), route('admin.account-group'));
    });
