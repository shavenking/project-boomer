<?php

Route::group(['prefix' => 'api/v1'], function () {
    $controller = DailyAppliancesController::class;

    Route::get('daily-appliances', "$controller@all");
    Route::get('projects/{projects}/daily-appliances/total-amount', "$controller@getTotalAmount")->middleware('role:*');

    Route::get('projects/{projects}/daily-appliances', "$controller@index")->middleware('role:*');
    Route::post('projects/{projects}/daily-appliances', "$controller@store")->middleware('role:field_engineer');
});
