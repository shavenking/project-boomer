<?php

Route::group(['prefix' => 'api/v1'], function () {
    get('daily-materials', DailyMaterialsController::class . '@all');
    resource('projects.daily-materials', DailyMaterialsController::class);
});
