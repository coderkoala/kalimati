<?php

use App\Http\Controllers\Backend\Actions\InvestigationController;
use Tabuna\Breadcrumbs\Trail;

Route::get('incident-investigation', [InvestigationController::class, 'index'])
    ->name('incident-investigation')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'));
        $trail->push(__('CRM'));
        $trail->push(__('Incident Investigation'), route('admin.incident-investigation'));
    });
