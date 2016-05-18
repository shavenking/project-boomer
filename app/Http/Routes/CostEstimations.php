<?php

Route::group(['prefix' => 'api/v1'], function () {
    get('cost-estimation-bounces', CostEstimationsController::class . '@allBounces');
    get('projects/{projectId}/bounces', CostEstimationsController::class . '@getBouncesByProject');
    post('projects/{projectId}/cost-estimations/{costEstimationId}/bounces', CostEstimationsController::class . '@storeBounce');
});

Route::group(['middleware' => ['csrftoken']], function () {
    resource('projects.cost-estimations', CostEstimationsController::class);
});
