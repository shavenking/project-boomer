<?php

Route::group(['prefix' => 'api/v1'], function () {
    get('daily-appliances', DailyAppliancesController::class . '@all');
    get('projects/{projects}/daily-appliances/total-amount', DailyAppliancesController::class . '@getTotalAmount');
    resource('projects.daily-appliances', DailyAppliancesController::class);
});
