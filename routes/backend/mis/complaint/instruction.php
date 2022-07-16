<?php

use Tabuna\Breadcrumbs\Trail;
use App\Http\Controllers\Backend\Actions\InstructionController;

Route::get('incident-instructions', [InstructionController::class, 'index'])
    ->name('incident-instructions')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'));
        $trail->push(__('CRM'));
        $trail->push(__('Instructions'), route('admin.incident-instructions'));
    });
