<?php

$controller = CostEstimationsController::class;

Route::group(['prefix' => 'api/v1'], function () use ($controller) {
    Route::get('cost-estimation-bounces', "$controller@allBounces");
    Route::get('projects/{projects}/bounces', "$controller@getBouncesByProject")->middleware('role:*');
    Route::post('projects/{projects}/cost-estimations/{costEstimations}/bounces', "$controller@storeBounce")->middleware('role:project_manager|estimation_manager');
});

Route::group(['middleware' => ['csrftoken']], function () use ($controller) {
    Route::get('projects/{projects}/cost-estimations', "$controller@index")->name('projects.cost-estimations.index')->middleware('role:*');
    Route::post('projects/{projects}/cost-estimations', "$controller@store")->name('projects.cost-estimations.store')->middleware('role:project_manager|estimation_manager');
    Route::get('projects/{projects}/cost-estimations/create', "$controller@create")->name('projects.cost-estimations.create')->middleware('role:project_manager|estimation_manager');
    Route::get('projects/{projects}/cost-estimations/{costEstimations}', "$controller@show")->name('projects.cost-estimations.show')->middleware('role:*');
});
