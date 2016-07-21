<?php

Route::group(['prefix' => 'api/v1/statistics'], function () {
    $controller = StatisticsController::class;

    Route::get('projects/{projects}/daily-labors', "$controller@dailyLabors");
});
