<?php
Route::group(['prefix' => 'api/v1'], function () {
    resource('projects.works.workitems', Projects\WorkitemsController::class);
    resource('projects.works', Projects\WorksController::class);
});
Route::group(['middleware' => ['csrftoken', 'localize']], function () {
    get('projects/{project}/works/search', Projects\WorksController::class . '@search')->name('projects.works.search');
    resource('projects.works.workitems', Projects\WorkitemsController::class);
    resource('projects.works', Projects\WorksController::class);
});
