<?php

Route::group(['prefix' => 'api/v1'], function () {
    $controller = LaborsController::class;

    Route::get('labors', "$controller@index");

    Route::post(
        'labors',
        "$controller@store"
    )->middleware('role:project_manager|field_engineer');
});
