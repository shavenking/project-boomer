<?php

Route::group(['middleware' => ['csrftoken']], function () {
    get('cost-estimation-bounces', CostEstimationsController::class . '@allBounces');
    get('projects/{projectId}/cost-estimations/{costEstimationId}/bounces', CostEstimationsController::class . '@indexBounce');
    post('projects/{projectId}/cost-estimations/{costEstimationId}/bounces', CostEstimationsController::class . '@storeBounce');
    resource('projects.cost-estimations', CostEstimationsController::class);
});
