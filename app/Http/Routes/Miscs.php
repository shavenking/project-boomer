<?php

Route::group(['middleware' => ['csrftoken']], function () {
    Route::get('/', function () {
        return view('index');
    })->name('index');

    Route::get('settings', function () {
        return view('settings.index');
    })->name('settings.index');

    Route::get('projects/{projects}/internal', ProjectsController::class . '@internal')->name('projects.internal.index')->middleware('role:*');
    Route::get('projects/{projects}/external', ProjectsController::class . '@external')->name('projects.external.index')->middleware('role:*');
    Route::get('projects/{projects}/finance', ProjectsController::class . '@finance')->name('projects.finance.index')->middleware('role:*');
});
