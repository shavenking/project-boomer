<?php

Route::group(['prefix' => 'api/v1'], function () {
    get('daily-materials', DailyMaterialsController::class . '@all');
    get('projects/{projects}/daily-materials/total-amount', DailyMaterialsController::class . '@getTotalAmount');
    resource('projects.daily-materials', DailyMaterialsController::class);
});
