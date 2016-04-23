<?php

Route::group(['prefix' => 'api/v1'], function () {
    get('daily-labors', DailyLaborsController::class . '@all');
    get('projects/{projects}/daily-labors/total-amount', DailyLaborsController::class . '@getTotalAmount');
    resource('projects.daily-labors', DailyLaborsController::class);
});
