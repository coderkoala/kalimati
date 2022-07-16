<?php
/*
* File services Routes
*
* These routes can only be accessed by users with type `admin`
*/

// display main layout
Route::get('/', [
    'uses' => 'UniSharp\LaravelFilemanager\Controllers\LfmController@show',
    'as' => 'show',
]);

// display integration error messages
Route::get('/errors', [
    'uses' => 'UniSharp\LaravelFilemanager\Controllers\LfmController@getErrors',
    'as' => 'getErrors',
]);

// upload
Route::any('/upload', [
    'uses' => 'UniSharp\LaravelFilemanager\Controllers\UploadController@upload',
    'as' => 'upload',
]);

// list images & files
Route::get('/jsonitems', [
    'uses' => 'UniSharp\LaravelFilemanager\Controllers\ItemsController@getItems',
    'as' => 'getItems',
]);

Route::get('/move', [
    'uses' => 'UniSharp\LaravelFilemanager\Controllers\ItemsController@move',
    'as' => 'move',
]);

Route::get('/domove', [
    'uses' => 'UniSharp\LaravelFilemanager\Controllers\ItemsController@domove',
    'as' => 'domove'
]);

// folders
Route::get('/newfolder', [
    'uses' => 'UniSharp\LaravelFilemanager\Controllers\FolderController@getAddfolder',
    'as' => 'getAddfolder',
]);

// list folders
Route::get('/folders', [
    'uses' => 'UniSharp\LaravelFilemanager\Controllers\FolderController@getFolders',
    'as' => 'getFolders',
]);

// crop
Route::get('/crop', [
    'uses' => 'UniSharp\LaravelFilemanager\Controllers\CropController@getCrop',
    'as' => 'getCrop',
]);
Route::get('/cropimage', [
    'uses' => 'UniSharp\LaravelFilemanager\Controllers\CropController@getCropimage',
    'as' => 'getCropimage',
]);
Route::get('/cropnewimage', [
    'uses' => 'UniSharp\LaravelFilemanager\Controllers\CropController@getNewCropimage',
    'as' => 'getCropnewimage',
]);

// rename
Route::get('/rename', [
    'uses' => 'UniSharp\LaravelFilemanager\Controllers\RenameController@getRename',
    'as' => 'getRename',
]);

// scale/resize
Route::get('/resize', [
    'uses' => 'UniSharp\LaravelFilemanager\Controllers\ResizeController@getResize',
    'as' => 'getResize',
]);
Route::get('/doresize', [
    'uses' => 'UniSharp\LaravelFilemanager\Controllers\ResizeController@performResize',
    'as' => 'performResize',
]);

// download
Route::get('/download', [
    'uses' => 'UniSharp\LaravelFilemanager\Controllers\DownloadController@getDownload',
    'as' => 'getDownload',
]);

// delete
Route::get('/delete', [
    'uses' => 'UniSharp\LaravelFilemanager\Controllers\DeleteController@getDelete',
    'as' => 'getDelete',
]);

Route::get('/demo', 'UniSharp\LaravelFilemanager\Controllers\DemoController@index');
