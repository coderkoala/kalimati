<?php

use App\Http\Controllers\Backend\CRM\AddressController;
use Tabuna\Breadcrumbs\Trail;

Route::get('account-address', [AddressController::class, 'index'])
    ->name('account-address')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'));
        $trail->push(__('CRM'));
        $trail->push(__('Account Groups Management'), route('admin.account-address'));
    });
