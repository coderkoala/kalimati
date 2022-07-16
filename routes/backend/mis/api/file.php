<?php

use App\Http\Controllers\Backend\FileUploadController;

// Allow uploading of file.
Route::post('starmis.api.upload', [FileUploadController::class, 'store'])->name('file.upload');

// Delete a specific file by hash ID.
Route::delete('starmis.api.upload/{id}', [FileUploadController::class, 'delete'])->name('file.delete');

// Allow download of file through hash.
Route::get('starmis.api.download/{hash}', [FileUploadController::class, 'get'])->name('file.download');
