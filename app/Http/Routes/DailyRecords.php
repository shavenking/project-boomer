<?php

Route::group(['prefix' => 'api/v1'], function () {
    resource('projects.daily-records', DailyRecordsController::class);
});
