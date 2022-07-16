<?php

use App\Http\Controllers\Backend\ArrivalLogController;
use App\Http\Controllers\Backend\ArticlesController;
use App\Http\Controllers\Backend\CommoditiesArrivalController;
use App\Http\Controllers\Backend\CommoditiesController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\LicenseController;
use App\Http\Controllers\Backend\NoticesController;
use App\Http\Controllers\Backend\PriceLogController;
use App\Http\Controllers\Backend\SettingsController;
use App\Http\Controllers\Backend\TradersDueController;
use App\Http\Controllers\Backend\TradersPaymentController;
use Tabuna\Breadcrumbs\Trail;

// All route names are prefixed with 'admin.'.
Route::redirect('/', '/admin/dashboard', 301);
Route::get('dashboard', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'));
    });

Route::post('settings-update', [SettingsController::class, 'post'])->name('setting');
Route::resource('license', LicenseController::class);
Route::resource('articles', ArticlesController::class);
Route::resource('commodities', CommoditiesController::class);
Route::resource('commodities-arrival', CommoditiesArrivalController::class);
Route::resource('pricelog', PriceLogController::class);
Route::resource('arrival', ArrivalLogController::class);
Route::resource('notices', NoticesController::class);
Route::resource('traderduespayment', TradersPaymentController::class);
Route::resource('traderdues', TradersDueController::class);
Route::post('traderdues/upload-data', [TradersDueController::class, 'upload'])->name('traderdues.upload');

Route::get('executive-settings', [SettingsController::class, 'getExecutiveSettings']);
Route::get('api-settings', [SettingsController::class, 'getAPISettings']);
Route::get('marquee-settings', [SettingsController::class, 'getMarqueeSettings']);
Route::get('url-settings', [SettingsController::class, 'getURLSettings']);

Route::get('menu', [ArticlesController::class, 'menu'])->name('showMenu');
Route::post('menu', [ArticlesController::class, 'menuR'])->name('updateMenu');
