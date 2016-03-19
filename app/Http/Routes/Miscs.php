<?php

Route::group(['middleware' => ['csrftoken', 'localize']], function () {
    get('/', function () {
        return view('index');
    })->name('index');

    get('settings', function () {
        return view('settings.index');
    })->name('settings.index');

    get('projects/{project}/internal', Projects\ProjectViewsController::class . '@internal')->name('projects.internal.index');
    get('projects/{project}/external', Projects\ProjectViewsController::class . '@external')->name('projects.external.index');
    get('projects/{project}/finance', Projects\ProjectViewsController::class . '@finance')->name('projects.finance.index');
});
