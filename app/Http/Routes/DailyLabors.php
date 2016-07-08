<?php

Route::group(['prefix' => 'api/v1'], function () {
    $controller = DailyLaborsController::class;

    Route::get('daily-labors', "$controller@all");
    Route::get('projects/{projects}/daily-labors/total-amount', "$controller@getTotalAmount");

    Route::get('projects/{projects}/daily-labors', "$controller@index");
    Route::post('projects/{projects}/daily-labors', "$controller@store")->middleware('role:field_engineer');
});
