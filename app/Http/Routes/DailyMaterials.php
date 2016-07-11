<?php

Route::group(['prefix' => 'api/v1'], function () {
    $controller = DailyMaterialsController::class;

    Route::get('daily-materials', "$controller@all");
    Route::get('projects/{projects}/daily-materials/total-amount', "$controller@getTotalAmount")->middleware('role:*');

    Route::get('projects/{projects}/daily-materials', "$controller@index")->middleware('role:*');
    Route::post('projects/{projects}/daily-materials', "$controller@store")->middleware('role:project_manager|field_engineer');
});
