<?php

use App\Http\Controllers\Backend\CRM\ContactController;
use Tabuna\Breadcrumbs\Trail;

Route::get('account-contacts', [ContactController::class, 'index'])
    ->name('account-contacts')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'));
        $trail->push(__('CRM'));
        $trail->push(__('Account Contacts Management'), route('admin.account-contacts'));
    });
