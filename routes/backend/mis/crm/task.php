<?php

use App\Http\Controllers\Backend\CRM\TasksController;
use Tabuna\Breadcrumbs\Trail;

Route::get('account-tasks', [TasksController::class, 'index'])
    ->name('account-tasks')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'));
        $trail->push(__('CRM'));
        $trail->push(__('Tasks Management'), route('admin.account-tasks'));
    });
