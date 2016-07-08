<?php

$workController = ProjectWorksController::class;
$estimationController = CostEstimationsController::class;

Route::group(['prefix' => 'api/v1'], function () use ($workController, $estimationController) {

    Route::get('projects/{projects}/works/{works}/cost-estimations/previous', "$estimationController@getPreviousEstimation");
    Route::get('projects/{projects}/works/{works}/cost-estimations', "$estimationController@estimations");
    Route::get('projects/{projects}/works/{works}/workitems', "$workController@indexOfWorkitems");
    Route::post('projects/{projects}/works/{works}/workitems', "$workController@storeOfWorkitems")->middleware('role:cost_manager');
    Route::put('projects/{projects}/works/{works}/workitems/{workitems}', "$workController@updateOfWorkitems")->middleware('role:cost_manager');
    Route::delete('projects/{projects}/works/{works}/workitems/{workitems}', "$workController@destroyOfWorkitems")->middleware('role:cost_manager');

    Route::get('projects/{projects}/works', "$workController@index");
    Route::post('projects/{projects}/works', "$workController@store")->middleware('role:cost_manager');
    Route::put('projects/{projects}/works/{works}', "$workController@update")->middleware('role:cost_manager');
    Route::delete('projects/{projects}/works/{works}', "$workController@destroy")->middleware('role:cost_manager');
});
Route::group(['middleware' => ['csrftoken']], function () use ($workController) {
    Route::get('projects/{projects}/works/{works}/workitems', "$workController@indexOfWorkitems")
        ->name('projects.works.workitems.index');
    Route::get('projects/{projects}/works/{works}/workitems/create', "$workController@createOfWorkitems")
        ->name('projects.works.workitems.create')->middleware('role:cost_manager');
    Route::post('projects/{projects}/works/{works}/workitems', "$workController@storeOfWorkitems")
        ->name('projects.works.workitems.store')->middleware('role:cost_manager');
    Route::put('projects/{projects}/works/{works}/workitems/{workitems}', "$workController@updateOfWorkitems")
        ->name('projects.works.workitems.update')->middleware('role:cost_manager');
    Route::delete('projects/{projects}/works/{works}/workitems/{workitems}', "$workController@destroyOfWorkitems")
        ->name('projects.works.workitems.destroy')->middleware('role:cost_manager');

    Route::get('projects/{project}/works/search', "$workController@search")->name('projects.works.search');

    Route::get('projects/{projects}/works', "$workController@index")->name('projects.works.index');
    Route::get('projects/{projects}/works/create', "$workController@create")->name('projects.works.create')->middleware('role:cost_manager');
    Route::post('projects/{projects}/works', "$workController@store")->name('projects.works.store')->middleware('role:cost_manager');
    Route::get('projects/{projects}/works/{works}', "$workController@show")->name('projects.works.show');
    Route::delete('projects/{projects}/works/{works}', "$workController@destroy")->name('projects.works.destroy')->middleware('role:cost_manager');
});
