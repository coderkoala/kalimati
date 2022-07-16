<?php

use Tabuna\Breadcrumbs\Trail;
use App\Http\Controllers\Backend\Actions\IncidentController;

Route::get('incident-events', [IncidentController::class, 'index'])
    ->name('incident-events')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'));
        $trail->push(__('CRM'));
        $trail->push(__('Incidents'), route('admin.incident-events'));
    });
