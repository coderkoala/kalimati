<?php

use App\Http\Controllers\Backend\Settings\API;

// API configuration.
Route::post('api.settings/{model}', [API::class, 'get'])->name('api.settings');

if (env('APP_ENV') === 'local') {
    Route::get('api.settings/{model}', [API::class, 'get'])->name('testAPI');
}

