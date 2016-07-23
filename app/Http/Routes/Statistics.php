<?php

Route::group(['prefix' => 'api/v1/statistics'], function () {
    $controller = StatisticsController::class;

    Route::get('projects/{projects}/daily-labors', "$controller@dailyLabors");
    Route::get(
        'projects/{projects}/daily-materials',
        "$controller@dailyMaterials"
    );
    Route::get(
        'projects/{projects}/daily-appliances',
        "$controller@dailyAppliances"
    );
});
