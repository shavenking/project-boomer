<?php

Route::group(['middleware' => ['csrftoken']], function () {
    resource('projects.cost-estimations', CostEstimationsController::class);
});
