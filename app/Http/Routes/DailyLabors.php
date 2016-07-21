<?php

Route::group(['prefix' => 'api/v1'], function () {
    $controller = DailyLaborsController::class;

    Route::get('daily-labors', "$controller@index");

    Route::post(
        'daily-labors',
        "$controller@store"
    )->middleware('role:project_manager|field_engineer');
});
