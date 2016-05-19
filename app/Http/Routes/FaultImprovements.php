<?php

Route::group(['prefix' => 'api/v1'], function () {
    put('projects/{projectId}/fault-improvements/{faultImprovementId}', FaultImprovementsController::class . '@update');
    post('projects/{projectId}/fault-improvements/{faultImprovementId}/photos/{step}', FaultImprovementsController::class . '@storePhotos');
});

Route::group(['middleware' => ['csrftoken']], function () {
    resource('projects.fault-improvements', FaultImprovementsController::class);
});
