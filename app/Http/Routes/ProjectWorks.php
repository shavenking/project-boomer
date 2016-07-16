<?php

$workController = ProjectWorksController::class;
$estimationController = CostEstimationsController::class;

Route::group(['prefix' => 'api/v1', 'middleware' => 'role:*'], function () use ($workController, $estimationController) {

    Route::get('projects/{projects}/works/{works}/cost-estimations/previous', "$estimationController@getPreviousEstimation");
    Route::get('projects/{projects}/works/{works}/cost-estimations', "$estimationController@estimations");
    Route::get('projects/{projects}/works/{works}/workitems', "$workController@indexOfWorkitems");
    Route::post('projects/{projects}/works/{works}/workitems', "$workController@storeOfWorkitems")->middleware('role:project_manager|cost_manager');
    Route::put('projects/{projects}/works/{works}/workitems/{workitems}', "$workController@updateOfWorkitems")->middleware('role:project_manager|cost_manager');
    Route::delete('projects/{projects}/works/{works}/workitems/{workitems}', "$workController@destroyOfWorkitems")->middleware('role:project_manager|cost_manager');

    Route::get('projects/{projects}/works', "$workController@index");
    Route::post('projects/{projects}/works', "$workController@store")->middleware('role:project_manager|cost_manager');
    Route::put('projects/{projects}/works/{works}', "$workController@update")->middleware('role:project_manager|cost_manager');
    Route::delete('projects/{projects}/works/{works}', "$workController@destroy")->middleware('role:project_manager|cost_manager');
});
Route::group(['middleware' => ['csrftoken', 'role:*']], function () use ($workController) {
    Route::get('projects/{projects}/works/{works}/workitems', "$workController@indexOfWorkitems")
        ->name('projects.works.workitems.index');
    Route::get('projects/{projects}/works/{works}/workitems/create', "$workController@createOfWorkitems")
        ->name('projects.works.workitems.create')->middleware('role:project_manager|cost_manager');
    Route::post('projects/{projects}/works/{works}/workitems', "$workController@storeOfWorkitems")
        ->name('projects.works.workitems.store')->middleware('role:project_manager|cost_manager');
    Route::put('projects/{projects}/works/{works}/workitems/{workitems}', "$workController@updateOfWorkitems")
        ->name('projects.works.workitems.update')->middleware('role:project_manager|cost_manager');
    Route::delete('projects/{projects}/works/{works}/workitems/{workitems}', "$workController@destroyOfWorkitems")
        ->name('projects.works.workitems.destroy')->middleware('role:project_manager|cost_manager');

    Route::get('projects/{projects}/works/search', "$workController@search")->name('projects.works.search');

    Route::get('projects/{projects}/works', "$workController@index")->name('projects.works.index');
    Route::get('projects/{projects}/works/create', "$workController@create")->name('projects.works.create')->middleware('role:project_manager|cost_manager');
    Route::post('projects/{projects}/works', "$workController@store")->name('projects.works.store')->middleware('role:project_manager|cost_manager');
    Route::get('projects/{projects}/works/{works}', "$workController@show")->name('projects.works.show');
    Route::delete('projects/{projects}/works/{works}', "$workController@destroy")->name('projects.works.destroy')->middleware('role:project_manager|cost_manager');
});
