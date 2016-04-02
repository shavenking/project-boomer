<?php

Route::group(['middleware' => ['csrftoken']], function () {
    get('/', function () {
        return view('index');
    })->name('index');

    get('settings', function () {
        return view('settings.index');
    })->name('settings.index');

    get('projects/{project}/internal', ProjectsController::class . '@internal')->name('projects.internal.index');
    get('projects/{project}/external', ProjectsController::class . '@external')->name('projects.external.index');
    get('projects/{project}/finance', ProjectsController::class . '@finance')->name('projects.finance.index');
});
