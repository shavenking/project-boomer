<?php

Route::group(['prefix' => 'api/v1'], function () {
    $controller = DailyRecordsController::class;

    Route::get('projects/{projects}/daily-records', "$controller@index")->middleware('role:*');
    Route::post('projects/{projects}/daily-records', "$controller@store")->middleware('role:field_engineer');
});
